<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengembalianRuangan extends Model
{
    use HasFactory;

    protected $table = 'pengembalian_ruangan';
    protected $fillable = [
        'peminjaman_ruangan_id',
        'tgl_dikembalikan',
        'status'
    ];

    // Relasi dengan Peminjaman
    public function peminjamanRuangan()
    {
        return $this->belongsTo(PeminjamanRuangan::class);
    }
}
