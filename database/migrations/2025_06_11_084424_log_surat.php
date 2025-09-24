<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_surat', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id();
            $table->integer('surat_id')->nullable();
            $table->datetime('waktu')->nullable();
            $table->integer('author')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_surat');
    }
};
