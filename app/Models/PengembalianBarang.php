<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengembalianBarang extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_barang';
    protected $fillable = [
        'peminjaman_barang_id',
        'jumlah_dikembalikan',
        'tgl_dikembalikan',
        'status'
    ];

    // Relasi dengan Peminjaman
    public function peminjamanBarang()
    {
        return $this->belongsTo(PeminjamanBarang::class);
    }
}
