<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth', 'verified'])->name('profile');

Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth', 'verified'])->name('settings');

Route::get('/upload', function () {
    return view('upload');
})->middleware(['auth', 'verified'])->name('upload');

Route::get('/save-file', function () {
    return view('save-file');
})->middleware(['auth', 'verified'])->name('save-file');

Route::get('/trash', function (Request $request) {
    $search = $request->get('search', '');
    $files = \App\Models\File::where('user_id', auth()->id())
        ->when($search, function($query) use ($search) {
            $query->where(function($q) use ($search) {
                $q->where('filename', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();
    return view('trash', compact('files', 'search'));
})->middleware(['auth', 'verified'])->name('trash');

Route::delete('/files/{file}/delete', [FileController::class, 'deletePermanent'])->name('files.delete-permanent');

Route::put('/profile', function () {
    // Profile update logic will be implemented here
    return redirect()->back()->with('success', 'Profile updated successfully!');
})->middleware(['auth', 'verified'])->name('profile.update');

Route::put('/password', function () {
    // Password update logic will be implemented here
    return redirect()->back()->with('success', 'Password changed successfully!');
})->middleware(['auth', 'verified'])->name('password.update');

// Route untuk upload file
Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');

// Route untuk save file
Route::post('/files/save', [FileController::class, 'save'])->name('files.save');

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
