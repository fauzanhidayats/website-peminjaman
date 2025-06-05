<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['photo', 'nama_barang', 'kondisi', 'lokasi', 'stok', 'status'];

    // Relasi dengan peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
