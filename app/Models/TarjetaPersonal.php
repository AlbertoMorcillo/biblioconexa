<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarjetaPersonal extends Model
{
    use HasFactory;

    protected $table = 'tarjeta_personal';

    protected $fillable = [
        'user_id', 'genero', 'fecha_nacimiento', 'nombre', 'primer_apellido',
        'segundo_apellido', 'correo_electronico', 'telefono', 'dni'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
