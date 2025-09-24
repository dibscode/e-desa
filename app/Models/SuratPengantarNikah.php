<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class SuratPengantarNikah extends Model
{
    use HasFactory;
    protected $table = 'surat_nikah';
    protected $primaryKey = 'id';
    protected $fillable = [
        'surat_id', 'user_id', 'date', 'file',
        'nik_ayah', 'nama_ayah', 'ttl_ayah', 'alamat_ayah', 'pekerjaan_ayah',
        'nik_ibu', 'nama_ibu', 'ttl_ibu', 'alamat_ibu', 'pekerjaan_ibu',
        'keterangan', 'status'
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
