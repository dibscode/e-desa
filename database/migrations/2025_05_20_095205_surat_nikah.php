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
        Schema::create('surat_nikah', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id();
            $table->integer('surat_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->date('date')->nullable();
            $table->string('file', 254)->nullable();
            $table->string('no_surat', 254)->nullable();
            $table->string('nik_ayah', 254)->nullable();
            $table->string('nama_ayah', 254)->nullable();
            $table->string('ttl_ayah', 254)->nullable();
            $table->string('alamat_ayah', 254)->nullable();
            $table->string('pekerjaan_ayah', 254)->nullable();
            $table->string('nik_ibu', 254)->nullable();
            $table->string('nama_ibu', 254)->nullable();
            $table->string('ttl_ibu', 254)->nullable();
            $table->string('alamat_ibu', 254)->nullable();
            $table->string('pekerjaan_ibu', 254)->nullable();
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
        Schema::dropIfExists('surat_nikah');
    }
};
