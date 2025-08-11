<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\File;
use Carbon\Carbon;

class CheckFileExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $file = File::where('short_link', $request->short_link)->first();

        if (!$file) {
            abort(404, 'Link tidak ditemukan.');
        }

        // Cek expired
        if ($file->expired_at && Carbon::now()->gt(Carbon::parse($file->expired_at))) {
            return response()->view('expired', ['message' => 'Link sudah expired.']);
        }

        return $next($request);
    }
}
