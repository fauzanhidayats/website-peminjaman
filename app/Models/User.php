<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    protected $fillable = [
        'photo',
        'username',
        'email',
        'password',
        'role_id'
    ];

    // Mendefinisikan relasi dengan model Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relasi dengan peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function hasRole($roleName)
    {
        return $this->role && $this->role->nama_role === $roleName;
    }
}
