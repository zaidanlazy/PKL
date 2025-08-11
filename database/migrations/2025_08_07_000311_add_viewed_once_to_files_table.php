<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom one_time_view dan viewed_once ke tabel files.
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
      // $table->boolean('one_time_view')->default(false); // kolom sudah ada
        });
    }

    /**
     * Rollback perubahan jika diperlukan.
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn(['one_time_view', 'viewed_once']);
        });
    }
};
