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
        Schema::create('produk', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id();
            $table->string('nama', 254); // <= 254 karakter
            $table->string('image', 254)->nullable(); // <= 254 karakter, nullable
            $table->double('harga')->default(0);
            $table->string('nomor_wa', 20)->nullable(); // nomor whatsapp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
