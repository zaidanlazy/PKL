<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        $files = File::latest()->get();
        return view('files', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:25600', // max 25MB
        ]);

        $path = $request->file('file')->store('files', 'public');

        $file = new File();
        $file->user_id = auth()->id(); // nullable jika tidak login
        $file->filename = $request->file('file')->getClientOriginalName();
        $file->path = $path;
        $file->save();

        return redirect()->back()->with('success', 'File berhasil diupload!');
    }

    public function share(Request $request, $fileId)
    {
        $file = \App\Models\File::findOrFail($fileId);
        $shareLink = asset('storage/' . $file->path);
        session()->flash('share_link_' . $file->id, $shareLink);
        return redirect()->back();
    }
}