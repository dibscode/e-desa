<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;
    protected $table = 'pajak';
    protected $primaryKey = 'id';
    protected $fillable = [
        'file',
        'nama',
        'user_id',
        'date',
        'total',
        'keterangan',
        'status'
    ];

    public function userOne()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
