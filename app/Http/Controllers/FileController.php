<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        $customFilename = $request->input('filename');
        $category = $request->input('category');
        $description = $request->input('description');

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = $customFilename ? $customFilename . '.' . $extension : $originalName;

        $path = $file->storeAs('files', $filename, 'public');

        File::create([
            'user_id' => null,
            'filename' => $filename,
            'path' => $path,
            'share_link' => 'private',
            'original_name' => $originalName,
            'category' => $category,
            'description' => $description,
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
            'one_time' => 'nullable|in:on'
        ]);

        $file = $request->file('file');
        $customFilename = $request->input('filename');
        $password = $request->input('password');
        $expiredDate = $request->input('expired_date') ?? now()->addYear();
        $oneTime = $request->has('one_time');
        $customLink = $request->input('custom_link');

        // Tentukan share link secara otomatis
        $shareLink = 'private'; // default
        if ($password) $shareLink = 'password';
        elseif ($customLink) $shareLink = 'public';
        elseif ($oneTime) $shareLink = 'private';

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = $customFilename ? $customFilename . '.' . $extension : $originalName;

        $path = $file->storeAs('files', $filename, 'public');

        $fileModel = File::create([
            'user_id' => null,
            'filename' => $filename,
            'path' => $path,
            'share_link' => $shareLink,
            'original_name' => $originalName,
            'password' => $password,
            'expired_at' => Carbon::parse($expiredDate),
            'one_time' => $oneTime,
            'custom_link' => $customLink
        ]);

        $shareUrl = $customLink
            ? url('/files/' . $customLink . '/download')
            : route('files.download', $fileModel->id);

        session()->flash('uploaded_file_link', $shareUrl);
        session()->flash('uploaded_file_name', $filename);
        session()->flash('uploaded_file_privacy', $shareLink);

        return redirect()->back()->with('success', 'File berhasil diupload! Link share telah dibuat.');
    }

 public function download(Request $request, $fileIdOrCustomLink)
{
    $file = File::where('id', $fileIdOrCustomLink)
                ->orWhere('custom_link', $fileIdOrCustomLink)
                ->firstOrFail();

    if ($file->share_link === 'password') {
        if (!$request->has('access_granted')) {
            return view('files.password', ['file' => $file]);
        }

        // masukan password 
        $inputPassword = $request->input('password_input');


        if ($inputPassword !== $file->password) {
            return back()->withErrors(['password_input' => 'Password salah!']);
        }
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

            return redirect()->back()->with('success', 'File has been permanently deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete file. Please try again.');
        }
    }

    public function checkPassword(Request $request, $id)
{
    $file = File::findOrFail($id);

    if ($request->input('password') === $file->password) {
        // Redirect ke download dengan akses granted
        return redirect()->route('files.download', ['fileIdOrCustomLink' => $file->custom_link ?? $file->id, 'access_granted' => true]);
    }

    return back()->withErrors(['password' => 'Password salah'])->withInput();
}

}
