<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanBarang extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_barang';
    protected $fillable = [
        'user_id',
        'barang_id',
        'jumlah',
        'kegiatan',
        'tgl_pinjam',
        'tgl_kembali',
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
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi dengan Pengembalian
    public function pengembalianBarang()
    {
        return $this->hasOne(PengembalianBarang::class);
    }
}
