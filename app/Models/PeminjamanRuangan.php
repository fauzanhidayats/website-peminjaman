<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PeminjamanRuangan extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_ruangan';
    protected $fillable = [
        'user_id',
        'ruangan_id',
        'kegiatan',
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
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    // Relasi dengan Pengembalian
    public function pengembalianRuangan()
    {
        return $this->hasOne(PengembalianRuangan::class);
    }
}
