<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profile';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title', 'logo', 'phone', 'nama_lurah', 'ttd_lurah', 'alamat', 'npwp', 'email',
        'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos', 'keterangan'
    ];
}
