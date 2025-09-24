<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new Profile([
            'title' => 'KANTOR',
            'desa' => 'DESA TARUM',
            'kecamatan' => 'KECAMATAN PRAJEKAN',
            'kabupaten' => 'PEMERINTAH KABUPATEN BONDOWOSO',
            'provinsi' => 'JAWA TIMUR',
            'alamat' => 'JL. TARUM – PRAJEKAN, RT.04 RW.02',
            'nama_lurah' => 2,
            'ttd_lurah' => 'ttd_lurah.jpg',
            'logo' => 'logo_desa.jpg',
            'kodepos' => 68285,
        ]);
        $user->save();
    }
}
