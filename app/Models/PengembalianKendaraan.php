<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengembalianKendaraan extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_kendaraan';
    protected $fillable = [
        'peminjaman_kendaraan_id',
        'tgl_dikembalikan',
        'status'
    ];

    // Relasi dengan Peminjaman
    public function peminjamanKendaraan()
    {
        return $this->belongsTo(PeminjamanKendaraan::class);
    }
}
