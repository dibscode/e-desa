<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Surat::insert([
            ['name' => 'SURAT KETERANGAN MENINGGAL'],
            ['name' => 'SURAT KETERANGAN MISKIN'],
            ['name' => 'SURAT PENGANTAR NIKAH'],
            ['name' => 'SURAT PENGAJUAN SKCK'],
            ['name' => 'SURAT KETERANGAN TANAH'],
            ['name' => 'SURAT KETERANGAN USAHA'],
            ['name' => 'SURAT KEHILANGAN BARANG'],
            ['name' => 'SURAT KETERANGAN DOMISILI'],
            ['name' => 'SURAT KETERANGAN AHLI WARIS'],
            ['name' => 'SURAT KETERANGAN BEDA NAMA'],
            ['name' => 'SURAT IJIN KERAMAIAN'],
        ]);
    }
}
