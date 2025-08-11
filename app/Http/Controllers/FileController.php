<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    public function welcome()
    {
        $files = File::latest()->get();
        return view('welcome', compact('files'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:25600',
            'filename' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500'
        ]);

        $file = $request->file('file');
        $filename = $request->input('filename')
            ? $request->input('filename') . '.' . $file->getClientOriginalExtension()
            : $file->getClientOriginalName();

        $path = $file->storeAs('files', $filename, 'public');

        File::create([
            'filename' => $filename,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'share_link' => 'private'
        ]);

        return redirect('/')->with('success', 'File berhasil disimpan!');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:25600',
            'filename' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'expired_date' => 'nullable|date',
            'custom_link' => 'nullable|string|max:255',
            'one_time' => 'nullable|in:on',
            'one_time_view' => 'nullable|in:on'
        ]);

        $file = $request->file('file');
        $filename = $request->input('filename')
            ? $request->input('filename') . '.' . $file->getClientOriginalExtension()
            : $file->getClientOriginalName();

        $path = $file->storeAs('files', $filename, 'public');

        $shareLink = 'private';
        if ($request->filled('password')) $shareLink = 'password';
        elseif ($request->filled('custom_link')) $shareLink = 'public';

        $fileModel = File::create([
            'filename' => $filename,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'password' => $request->input('password'),
            'expired_at' => $request->input('expired_date') ?? now()->addYear(),
            'one_time' => $request->has('one_time'),
            'one_time_view' => $request->has('one_time_view'),
            'viewed_once' => false,
            'custom_link' => $request->input('custom_link'),
            'share_link' => $shareLink
        ]);

        $shareUrl = $fileModel->custom_link
            ? url('/files/' . $fileModel->custom_link . '/view')
            : route('files.view', $fileModel->id);

        session()->flash('uploaded_file_link', $shareUrl);
        session()->flash('uploaded_file_name', $filename);
        session()->flash('uploaded_file_privacy', $shareLink);

        return redirect()->back()->with('success', 'File berhasil diupload! Link share telah dibuat.');
    }

    public function viewFile(Request $request, $fileIdOrCustomLink)
    {
        $file = File::where('id', $fileIdOrCustomLink)
                    ->orWhere('custom_link', $fileIdOrCustomLink)
                    ->firstOrFail();

        if ($file->expired_at && now()->greaterThan($file->expired_at)) {
            return response()->view('files.expired', [], 410);
        }

        if ($file->one_time_view && $file->viewed_once) {
            return response()->view('files.expired', [], 410);
        }

        if ($file->one_time_view && !$file->viewed_once) {
            $file->viewed_once = true;
            $file->save();
        }

        if ($file->share_link === 'password') {
            $attempts = session()->get('password_attempts_' . $file->id, 0);
            $granted = session()->get('access_granted_' . $file->id, false);

            if ($attempts >= 5) {
                return response()->view('files.expired', [], 403);
            }

            if (!$granted) {
                return view('files.password', ['file' => $file]);
            }
        }

        return view('files.view', ['file' => $file]);
    }

    public function viewCustomLink($customLink)
    {
        return $this->viewFile(request(), $customLink);
    }

    public function checkPassword(Request $request, $id)
    {
        $file = File::findOrFail($id);
        $inputPassword = $request->input('password_input');

        if (!$file->password || $inputPassword === $file->password) {
            session()->put('access_granted_' . $file->id, true);
            session()->forget('password_attempts_' . $file->id);
            return redirect()->route('files.view', $file->custom_link ?? $file->id);
        }

        $attempts = session()->get('password_attempts_' . $file->id, 0) + 1;
        session()->put('password_attempts_' . $file->id, $attempts);

        if ($attempts >= 5) {
            return response()->view('files.expired', [], 403);
        }

        return back()->withErrors(['password_input' => 'Password salah'])->withInput();
    }

    public function download(Request $request, $fileIdOrCustomLink)
    {
        $file = File::where('id', $fileIdOrCustomLink)
                    ->orWhere('custom_link', $fileIdOrCustomLink)
                    ->firstOrFail();

        if ($file->expired_at && now()->greaterThan($file->expired_at)) {
            return response()->view('files.expired', [], 410);
        }

        if ($file->one_time_view && $file->viewed_once) {
            return response()->view('files.expired', [], 410);
        }

        if ($file->share_link === 'password' && !session()->get('access_granted_' . $file->id)) {
            return redirect()->route('files.view', ['fileIdOrCustomLink' => $file->custom_link ?? $file->id]);
        }

        if (!file_exists(storage_path('app/public/' . $file->path))) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->download(storage_path('app/public/' . $file->path), $file->filename);
    }

    public function share(Request $request, $fileId)
    {
        $file = File::findOrFail($fileId);
        $shareLink = asset('storage/' . $file->path);
        session()->flash('share_link_' . $file->id, $shareLink);
        return redirect()->back();
    }

    public function deletePermanent($fileId)
    {
        $file = File::findOrFail($fileId);

        try {
            if (file_exists(storage_path('app/public/' . $file->path))) {
                unlink(storage_path('app/public/' . $file->path));
            }

            $file->delete();
            return redirect()->back()->with('success', 'File berhasil dihapus permanen.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus file. Silakan coba lagi.');
        }
    }

    // Tambahan: Hapus Semua File Permanen
    public function deleteAllPermanent()
    {
        $files = File::all();

        try {
            File::onlyTrashed()->forceDelete();
        return redirect()->route('files.trash')->with('success', 'Semua file di Trash berhasil dihapus permanen.');
    } catch (\Exception $e) {
        return redirect()->route('files.trash')->with('error', 'Gagal menghapus semua file: ' . $e->getMessage());
    }
}
}
