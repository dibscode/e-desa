<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lapor extends Model
{
    use HasFactory;

    protected $table = 'lapor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'foto',
        'deskripsi',
        'status',
        'nomor_wa',
    ];

    /**
     * Accessor to get full URL for foto if stored in storage disk.
     */
    public function getFotoUrlAttribute()
    {
        if (empty($this->foto)) {
            return null;
        }

        // If foto already looks like a full URL, return it.
        if (preg_match('/^https?:\/\//i', $this->foto)) {
            return $this->foto;
        }

        // Try common storage path on the public disk; return an asset-based URL.
        if (Storage::disk('public')->exists($this->foto)) {
            return asset('storage/' . ltrim($this->foto, '/'));
        }

        // Fallback to asset path
        return asset('storage/' . ltrim($this->foto, '/'));
    }

    /**
     * Scope to filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
