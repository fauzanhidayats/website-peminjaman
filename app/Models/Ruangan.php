<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $fillable = ['photo', 'nama_ruangan', 'kondisi', 'kapasitas', 'lokasi', 'status'];

    // Relasi dengan peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
