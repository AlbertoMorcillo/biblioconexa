<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';  
    public $incrementing = true;   
    protected $keyType = 'int';   

    protected $fillable = [
        'dni', 
        'name', 
        'surname', 
        'email', 
        'password', 
        'phone', 
        'birthdate', 
        'isAdmin'
    ];
    protected $hidden = [
        'password', 
        'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'isAdmin' => 'boolean', // Asegúrate de manejar isAdmin como booleano
    ];

    // Relaciones
    public function estanterias()
    {
        return $this->hasMany(Estanterias::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}

