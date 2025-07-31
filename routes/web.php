<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $notifications = [
        (object)[ 'message' => 'Selamat datang di dashboard!' ],
        (object)[ 'message' => 'Notifikasi contoh, sistem siap digunakan.' ]
    ];
    return view('dashboard', compact('notifications'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk upload file
Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');

// Route untuk daftar file user
Route::get('/files', [FileController::class, 'index'])->name('files.index');

// Route untuk share file (generate link)
Route::post('/files/{file}/share', [FileController::class, 'share'])->name('files.share');

// Route untuk hapus file
Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

// Route untuk download file via link
Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');

// Route untuk request akses ulang
Route::post('/files/{file}/request-access', [FileController::class, 'requestAccess'])->name('files.request-access');

require __DIR__.'/auth.php';
