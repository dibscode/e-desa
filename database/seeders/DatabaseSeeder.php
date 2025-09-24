<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('profile')->truncate();
        DB::table('surat')->truncate();

        $this->call([
            UserSeeder::class,
            MasyarakatSeeder::class,
            ProfileSeeder::class,
            SuratSeeder::class,
            KeuanganDesaSeeder::class,
            PajakSeeder::class,
            ProdukSeeder::class,
            BeritaSeeder::class,
        ]);
    }
}
