<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->text('isi');
            $table->string('gambar1', 255)->nullable();
            $table->string('gambar2', 255)->nullable();
            $table->string('gambar3', 255)->nullable();
            $table->string('kategori', 100)->nullable();
            $table->string('penulis', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
