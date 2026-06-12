<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Penulis extends Authenticatable
{
    protected $table = 'penulis';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'user_name',
        'password',
        'foto',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id_penulis');
    }
}