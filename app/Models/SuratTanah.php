<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTanah extends Model
{
    use HasFactory;
    protected $table = 'surat_tanah';
    protected $primaryKey = 'id';
    protected $fillable = [
        'surat_id',
        'user_id',
        'date',
        'file',
        'no_surat',
        'nama_pemilik',
        'nik_pemilik',
        'alamat_pemilik',
        'luas_tanah',
        'letak_tanah',
        'keterangan',
        'status'
    ];
    
    public function userOne()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function suratOne()
    {
        return $this->hasOne(Surat::class, 'id', 'surat_id');
    }
}
