<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('files', function (Blueprint $table) {
        $table->string('custom_link')->nullable()->unique();
        $table->string('password')->nullable();
        $table->timestamp('expired_at')->nullable();
        $table->boolean('one_time')->default(false);
    });
}

public function down()
{
    Schema::table('files', function (Blueprint $table) {
        $table->dropColumn(['custom_link', 'password', 'expired_at', 'one_time']);
    });
}


};
