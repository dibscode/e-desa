<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar1',
        'gambar2',
        'gambar3',
        'kategori',
        'penulis',
        'views'
    ];
}
