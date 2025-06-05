<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{

    use HasFactory;
    // Menentukan nama tabel jika tidak mengikuti konvensi
    protected $table = 'roles';

    // Mendefinisikan relasi dengan model User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
