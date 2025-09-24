<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pajak')->insert([
            [
                'date' => Carbon::create('2025', '01', '02'),
                'file' => null,
                'nama' => 'Pajak PBB - RT 01',
                'user_id' => 1,
                'total' => 150000,
                'keterangan' => 'Pajak tanah RT 01',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::create('2025', '02', '10'),
                'file' => null,
                'nama' => 'Pajak Reklame',
                'user_id' => 2,
                'total' => 500000,
                'keterangan' => 'Pajak reklame pasar',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::create('2025', '03', '15'),
                'file' => null,
                'nama' => 'Pajak Parkir',
                'user_id' => 3,
                'total' => 75000,
                'keterangan' => 'Pajak parkir pasar',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
