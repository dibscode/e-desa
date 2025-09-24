<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratDomisili extends Model
{
    use HasFactory;
    protected $table = 'surat_domisili';
    protected $primaryKey = 'id';
    protected $fillable = [
        'surat_id',
        'user_id',
        'date',
        'file',
        'no_surat',
        'keperluan',
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
