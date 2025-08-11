<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;

// =======================
// Halaman utama & static
// =======================
Route::get('/', [FileController::class, 'welcome'])->name('home');
Route::get('/upload', fn() => view('upload'))->name('upload');
Route::get('/save-file', fn() => view('save-file'))->name('save-file');
Route::get('/profile', fn() => view('profile'))->name('profile');
Route::get('/settings', fn() => view('settings'))->name('settings');

// =======================
// Trash (dengan pencarian)
// =======================
Route::get('/trash', function (Request $request) {
    $search = $request->get('search', '');
    $files = \App\Models\File::query()
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('filename', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();
    return view('trash', compact('files', 'search'));
})->name('trash');

// =======================
// Proses Upload / Save File
// =======================
Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
Route::post('/files/save', [FileController::class, 'save'])->name('files.save');

// =======================
// File Management Routes
// =======================
Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::post('/files/{file}/share', [FileController::class, 'share'])->name('files.share');

// ✅ View File (via ID atau custom link)
Route::get('/files/{fileIdOrCustomLink}/view', [FileController::class, 'viewFile'])->name('files.view');

// ✅ Cek Password File
Route::post('/files/{id}/check-password', [FileController::class, 'checkPassword'])->name('files.check-password');

// ✅ Download File (harus lolos validasi password kalau ada)
Route::get('/files/{fileIdOrCustomLink}/download', [FileController::class, 'download'])->name('files.download');

// ✅ Hapus File (Soft Delete & Permanent Delete)
Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');
Route::delete('/files/{file}/delete', [FileController::class, 'deletePermanent'])->name('files.delete-permanent');

// ✅ Minta Akses Ulang (opsional)
Route::post('/files/{file}/request-access', [FileController::class, 'requestAccess'])->name('files.request-access');

// =======================
// Update Profil Dummy
// =======================
Route::put('/profile', fn() => back()->with('success', 'Profile updated successfully!'))->name('profile.update');
Route::put('/password', fn() => back()->with('success', 'Password changed successfully!'))->name('password.update');
// =======================
// (Optional) Route khusus untuk share link seperti /s/{custom}
// =======================
Route::get('/s/{customLink}', [FileController::class, 'showCustomLink'])->name('files.share-link');

// =======================
// Catch-all untuk custom link (bukan /files/)
// =======================
// khusu paling bawah untuk menangani custom link yang tidak menggunakan prefix /files/
Route::get('/{customLink}', [FileController::class, 'viewCustomLink'])
    ->where('customLink', '^[a-zA-Z0-9\-_]+$')
    ->name('files.custom-link');
