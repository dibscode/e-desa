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
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->id();
            $table->string('level', 100);
            $table->string('nik', 20)->unique();
            $table->string('no_kk', 20)->nullable();
            $table->string('username', 100)->unique();
            $table->string('name', 254)->nullable();
            $table->string('email', 254)->nullable();
            $table->integer('phone')->nullable();
            $table->integer('gender')->nullable()->comment('1: Perempuan, 2: Laki-Laki');
            $table->string('password', 254)->nullable();
            $table->string('avatar', 254)->nullable();
            $table->string('birthplace', 254)->nullable();
            $table->date('birthdate', 254)->nullable();
            $table->integer('age')->nullable();
            $table->string('agama', 254)->nullable();
            $table->string('alamat', 254)->nullable();
            $table->string('rtrw', 20)->nullable();
            $table->string('desa', 254)->nullable();
            $table->string('kecamatan', 254)->nullable();
            $table->string('kabupaten', 254)->nullable();
            $table->string('provinsi', 254)->nullable();
            $table->string('pekerjaan', 254)->nullable();
            $table->string('pendidikan', 254)->nullable();
            $table->string('kewarganegaraan', 254)->nullable();
            $table->integer('status')->nullable()->comment('1: Belum Kawin, 2: Kawin, 3: Cerai Hidup, 4: Cerai Mati');
            $table->integer('status_user')->default(0)->comment('0: Belum Aktif, 1: Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
