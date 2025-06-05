<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanKendaraan extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_kendaraan';
    protected $fillable = [
        'user_id',
        'kendaraan_id',
        'keperluan',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'surat_peminjaman',
        'tgl_cetak_surat'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Barang
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // Relasi dengan Pengembalian
    public function pengembalianKendaraan()
    {
        return $this->hasOne(PengembalianKendaraan::class);
    }
}
