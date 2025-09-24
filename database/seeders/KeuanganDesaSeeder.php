<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuanganDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keuangan_desa')->insert([
            [
                'tanggal' => '2025-01-01',
                'kode_rekening' => '1.1.01',
                'uraian' => 'Dana Desa (DD) Tahap I',
                'jenis_transaksi' => 'Pemasukan',
                'pemasukan' => 100000000,
                'pengeluaran' => 0,
                'sumber_dana' => 'APBN',
                'keterangan' => 'Transfer dari pusat',
            ],
            [
                'tanggal' => '2025-01-05',
                'kode_rekening' => '5.2.01',
                'uraian' => 'Pembangunan Jalan RT 02',
                'jenis_transaksi' => 'Pengeluaran',
                'pemasukan' => 0,
                'pengeluaran' => 30000000,
                'sumber_dana' => 'Dana Desa',
                'keterangan' => 'Realisasi fisik 40%',
            ],
            [
                'tanggal' => '2025-01-10',
                'kode_rekening' => '5.2.02',
                'uraian' => 'Pelatihan PKK',
                'jenis_transaksi' => 'Pengeluaran',
                'pemasukan' => 0,
                'pengeluaran' => 5000000,
                'sumber_dana' => 'ADD',
                'keterangan' => 'Honor dan konsumsi',
            ],
            [
                'tanggal' => '2025-01-15',
                'kode_rekening' => '1.2.01',
                'uraian' => 'Bantuan Provinsi',
                'jenis_transaksi' => 'Pemasukan',
                'pemasukan' => 20000000,
                'pengeluaran' => 0,
                'sumber_dana' => 'Provinsi',
                'keterangan' => 'Dana bantuan kegiatan desa',
            ],
            [
                'tanggal' => '2025-01-20',
                'kode_rekening' => '5.3.01',
                'uraian' => 'Biaya Operasional Kantor',
                'jenis_transaksi' => 'Pengeluaran',
                'pemasukan' => 0,
                'pengeluaran' => 3500000,
                'sumber_dana' => 'ADD',
                'keterangan' => 'ATK dan listrik',
            ],
        ]);
    }
}
