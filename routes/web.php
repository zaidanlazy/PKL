<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;

// Halaman utama - gunakan controller agar terstruktur
Route::get('/', [FileController::class, 'welcome'])->name('home');

// Halaman profil (dummy)
Route::get('/profile', fn() => view('profile'))->name('profile');

// Halaman pengaturan (dummy)
Route::get('/settings', fn() => view('settings'))->name('settings');

// Halaman upload
Route::get('/upload', fn() => view('upload'))->name('upload');

// Halaman save file
Route::get('/save-file', fn() => view('save-file'))->name('save-file');

// Halaman trash
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

// Upload file
Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');

// Save file
Route::post('/files/save', [FileController::class, 'save'])->name('files.save');

// Daftar file
Route::get('/files', [FileController::class, 'index'])->name('files.index');

// Share file
Route::post('/files/{file}/share', [FileController::class, 'share'])->name('files.share');

// Download file
Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');

// Soft delete (opsional kalau nanti dipakai)
Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

// Delete permanen
Route::delete('/files/{file}/delete', [FileController::class, 'deletePermanent'])->name('files.delete-permanent');

// Minta akses ulang (fitur tambahan opsional)
Route::post('/files/{file}/request-access', [FileController::class, 'requestAccess'])->name('files.request-access');

// Update profil dummy
Route::put('/profile', fn() => back()->with('success', 'Profile updated successfully!'))->name('profile.update');

// Update password dummy
Route::put('/password', fn() => back()->with('success', 'Password changed successfully!'))->name('password.update');

Route::post('/files/{id}/check-password', [FileController::class, 'checkPassword'])->name('files.check-password');


// Tidak perlu require auth.php jika tidak menggunakan auth
