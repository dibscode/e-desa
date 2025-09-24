<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['belum', 'proses', 'selesai'])->default('belum');
            $table->string('nomor_wa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lapor');
    }
};
