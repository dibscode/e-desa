<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produkList = [
            [
                'nama' => 'Beras Tarum Premium',
                'image' => null,
                'harga' => 65000,
                'nomor_wa' => '6281234567001',
            ],
            [
                'nama' => 'Gula Aren Asli',
                'image' => null,
                'harga' => 35000,
                'nomor_wa' => '6281234567002',
                
            ],
            [
                'nama' => 'Kopi Robusta Desa',
                'image' => null,
                'harga' => 45000,
                'nomor_wa' => '6281234567003',
                
            ],
            [
                'nama' => 'Kopi Robusta Desa',
                'image' => null,
                'harga' => 45000,
                'nomor_wa' => '6281234567003',
                
            ],
        ];
        foreach ($produkList as $produk) {
            Produk::create($produk);
        }
    }
}
