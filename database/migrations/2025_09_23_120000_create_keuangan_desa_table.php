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
        Schema::create('keuangan_desa', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('kode_rekening', 20);
            $table->string('uraian', 255);
            $table->enum('jenis_transaksi', ['Pemasukan', 'Pengeluaran']);
            $table->decimal('pemasukan', 15, 2)->default(0);
            $table->decimal('pengeluaran', 15, 2)->default(0);
            $table->string('sumber_dana', 100)->nullable();
            $table->text('keterangan')->nullable();
            // created_at only (match requested schema)
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keuangan_desa');
    }
};
