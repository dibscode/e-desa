<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeteranganMeninggal extends Model
{
    use HasFactory;
    protected $table = 'surat_meninggal';
    protected $fillable = [
        'user_id',
        'surat_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'tanggal_meninggal',
        'tempat_meninggal',
        'sebab_meninggal',
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
