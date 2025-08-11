<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Scheduling\Schedule;


class DeleteExpiredFiles extends Command
{
    protected $signature = 'files:delete-expired';
    protected $description = 'Menghapus file yang sudah expired dari storage dan database';

    public function handle()
    {
        $now = Carbon::now();
        $expiredFiles = File::whereNotNull('expired_at')
            ->where('expired_at', '<', $now)
            ->get();

        $deletedCount = 0;

        foreach ($expiredFiles as $file) {
            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
            }

            $file->delete();
            $deletedCount++;
        }

        $this->info("Selesai! $deletedCount file expired berhasil dihapus.");
    }

    protected function schedule(Schedule $schedule)
{
    // Hapus file expired setiap hari jam 00:00
    $schedule->command('files:delete-expired')->daily();
}

}
