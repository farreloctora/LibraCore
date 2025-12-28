<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Koleksi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'judul',
        'penulis',
        'isbn',
        'tahun_terbit',
        'penerbit',
        'deskripsi',
        'status',
        'cover_path',
        'category_id',
    ];

    /**
     * Get the category that owns the koleksi.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the peminjamans for the koleksi.
     */
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    /**
     * Check if koleksi is available.
     */
    public function isAvailable(): bool
    {
        return $this->status === 'tersedia';
    }

    /**
     * Check if koleksi is currently borrowed.
     */
    public function isBorrowed(): bool
    {
        return $this->peminjamans()
            ->where('status', 'dipinjam')
            ->exists();
    }
}

