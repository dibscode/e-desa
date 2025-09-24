<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogSurat extends Model
{
    use HasFactory;
    protected $table = 'log_surat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'surat_id', 'author', 'keterangan', 'waktu'
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
