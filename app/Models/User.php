<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'dni';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'dni',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación uno a uno con TarjetaPersonal
    public function tarjetaPersonal()
    {
        return $this->hasOne(TarjetaPersonal::class, 'user_dni', 'dni');
    }

    // Relación uno a muchos con Estanterias
    public function estanterias()
    {
        return $this->belongsTo(User::class, 'UsuarioDNI', 'dni');
    }

    // Relación muchos a muchos con Libros a través de EstanteriasLibros
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'estanteriaslibros', 'EstanteriasID', 'LibroID');
    }
}
