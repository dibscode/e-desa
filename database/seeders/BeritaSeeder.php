<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Pembangunan Jalan Desa Tarum Selesai',
                'slug' => Str::slug('Pembangunan Jalan Desa Tarum Selesai'),
                'isi' => 'Pembangunan jalan utama Desa Tarum telah selesai dan kini dapat digunakan warga untuk aktivitas sehari-hari.',
                'gambar1' => null,
                'gambar2' => null,
                'gambar3' => null,
                'kategori' => 'Pembangunan',
                'penulis' => 'Admin',
            ],
            [
                'judul' => 'Panen Raya Padi Tahun Ini Melimpah',
                'slug' => Str::slug('Panen Raya Padi Tahun Ini Melimpah'),
                'isi' => 'Petani Desa Tarum bersyukur atas hasil panen padi yang melimpah pada musim ini.',
                'gambar1' => null,
                'gambar2' => null,
                'gambar3' => null,
                'kategori' => 'Pertanian',
                'penulis' => 'Admin',
            ],
            [
                'judul' => 'Lomba 17 Agustus Meriahkan Desa',
                'slug' => Str::slug('Lomba 17 Agustus Meriahkan Desa'),
                'isi' => 'Berbagai lomba diadakan untuk memeriahkan HUT RI ke-80 di Desa Tarum.',
                'gambar1' => null,
                'gambar2' => null,
                'gambar3' => null,
                'kategori' => 'Kegiatan',
                'penulis' => 'Admin',
            ],
            [
                'judul' => 'Pelatihan UMKM untuk Warga',
                'slug' => Str::slug('Pelatihan UMKM untuk Warga'),
                'isi' => 'Pemerintah desa mengadakan pelatihan UMKM untuk meningkatkan ekonomi warga.',
                'gambar1' => null,
                'gambar2' => null,
                'gambar3' => null,
                'kategori' => 'Ekonomi',
                'penulis' => 'Admin',
            ],
        ];
        foreach ($data as $berita) {
            Berita::create($berita);
        }
    }
}
