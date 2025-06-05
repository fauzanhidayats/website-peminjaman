<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraan';
    protected $fillable = ['photo', 'nama_kendaraan', 'jenis', 'nomor_polisi', 'kondisi', 'status'];

    // Relasi dengan peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
