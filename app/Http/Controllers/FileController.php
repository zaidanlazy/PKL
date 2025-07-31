<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request)
    {
        // Dummy response
        return redirect()->back()->with('notification', 'Upload berhasil (dummy)');
    }

    public function index()
    {
        // Dummy data file
        $files = [
            (object)[
                'id' => 1,
                'name' => 'Contoh File 1.pdf',
                'description' => 'Ini adalah file PDF contoh.',
                'tags' => ['dokumen', 'pdf']
            ],
            (object)[
                'id' => 2,
                'name' => 'Gambar Kucing.png',
                'description' => 'Gambar kucing lucu.',
                'tags' => ['gambar', 'kucing']
            ],
            (object)[
                'id' => 3,
                'name' => 'Data.xlsx',
                'description' => 'File data excel.',
                'tags' => ['data', 'excel']
            ]
        ];
        return view('files', compact('files'));
    }

    public function share($file, Request $request)
    {
        // Dummy link
        $link = url('/shared-link/'.$file.'-dummy-link');
        return redirect()->route('files.index')->with('share_link', $link);
    }

    public function destroy($file)
    {
        // Dummy response
        return redirect()->route('files.index')->with('notification', 'File berhasil dihapus (dummy)');
    }

    public function download($file)
    {
        // Dummy response
        return response('Download dummy file: '.$file);
    }

    public function requestAccess($file)
    {
        // Dummy response
        return redirect()->back()->with('notification', 'Permintaan akses ulang sudah dikirim (dummy)');
    }
}
