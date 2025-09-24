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
        Schema::create('surat_domisili', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id();
            $table->integer('surat_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('date')->nullable();
            $table->string('file', 254)->nullable();
            $table->string('no_surat', 254)->nullable();
            $table->string('keperluan', 254)->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('status')->default(0)->comment('0: Pengajuan, 1: Selesai, 2:Ditolak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_domisili');
    }
};
