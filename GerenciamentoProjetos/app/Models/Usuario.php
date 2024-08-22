<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\DashboardController;

class Usuario extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'nome', 'email', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isUsuario()
    {
        return $this->tipo === 'usuario';
    }

}
