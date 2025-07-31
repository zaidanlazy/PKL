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
            'file' => 'required|file|max:25600', // 25MB max
            'filename' => 'nullable|string|max:255',
            'share_link' => 'required|in:public,private,password,request'
        ]);

        $file = $request->file('file');
        $customFilename = $request->input('filename');
        $shareLink = $request->input('share_link');
        
        // Generate unique filename
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = $customFilename ? $customFilename . '.' . $extension : $originalName;
        
        // Store file
        $path = $file->storeAs('files', $filename, 'public');
        
        // Save to database
        $fileModel = \App\Models\File::create([
            'user_id' => auth()->id(),
            'filename' => $filename,
            'path' => $path,
            'share_link' => $shareLink,
            'original_name' => $originalName
        ]);

        // Generate share link
        $shareUrl = route('files.download', $fileModel->id);
        
        // Flash the share link to session
        session()->flash('uploaded_file_link', $shareUrl);
        session()->flash('uploaded_file_name', $filename);
        session()->flash('uploaded_file_privacy', $shareLink);

        return redirect()->back()->with('success', 'File berhasil diupload! Link share telah dibuat.');
    }

    public function save(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:25600', // 25MB max
            'filename' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500'
        ]);

        $file = $request->file('file');
        $customFilename = $request->input('filename');
        $category = $request->input('category');
        $description = $request->input('description');
        
        // Generate unique filename
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = $customFilename ? $customFilename . '.' . $extension : $originalName;
        
        // Store file
        $path = $file->storeAs('files', $filename, 'public');
        
        // Save to database
        $fileModel = \App\Models\File::create([
            'user_id' => auth()->id(),
            'filename' => $filename,
            'path' => $path,
            'share_link' => 'private', // Default private for saved files
            'original_name' => $originalName,
            'category' => $category,
            'description' => $description
        ]);

        return redirect()->back()->with('success', 'File berhasil disimpan ke penyimpanan Anda!');
    }

    public function share(Request $request, $fileId)
    {
        $file = \App\Models\File::findOrFail($fileId);
        $shareLink = asset('storage/' . $file->path);
        session()->flash('share_link_' . $file->id, $shareLink);
        return redirect()->back();
    }

    public function download($fileId)
    {
        $file = File::findOrFail($fileId);
        
        // Check if file exists
        if (!file_exists(storage_path('app/public/' . $file->path))) {
            abort(404, 'File not found');
        }
        
        // For now, allow all downloads (you can add privacy checks here later)
        return response()->download(storage_path('app/public/' . $file->path), $file->filename);
    }

    public function deletePermanent($fileId)
    {
        $file = File::findOrFail($fileId);
        
        // Check if user owns the file
        if ($file->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You do not have permission to delete this file.');
        }
        
        try {
            // Delete physical file
            if (file_exists(storage_path('app/public/' . $file->path))) {
                unlink(storage_path('app/public/' . $file->path));
            }
            
            // Delete from database
            $file->delete();
            
            return redirect()->back()->with('success', 'File has been permanently deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete file. Please try again.');
        }
    }
}