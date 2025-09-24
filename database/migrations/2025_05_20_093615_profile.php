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
        Schema::create('profile', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id();
            $table->string('title', 100)->nullable();
            $table->string('logo', 254)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('npwp', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->integer('nama_lurah')->nullable()->comment('user_id');
            $table->string('ttd_lurah', 254)->nullable();
            $table->string('alamat', 254)->nullable();
            $table->string('desa', 254)->nullable();
            $table->string('kecamatan', 254)->nullable();
            $table->string('kabupaten', 254)->nullable();
            $table->string('provinsi', 254)->nullable();
            $table->integer('kodepos')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
