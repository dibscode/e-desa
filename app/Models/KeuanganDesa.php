<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuanganDesa extends Model
{
    use HasFactory;

    protected $table = 'keuangan_desa';

    // Only created_at is present in migration
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = null;

    protected $fillable = [
        'tanggal',
        'kode_rekening',
        'uraian',
        'jenis_transaksi',
        'pemasukan',
        'pengeluaran',
        'sumber_dana',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'pemasukan' => 'decimal:2',
        'pengeluaran' => 'decimal:2',
    ];
}
