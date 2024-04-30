<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'evento';

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'hora',
        'sala',
        'UsuarioDNI',
        'user_id'  // Asegúrate de incluir el user_id si vas a vincular cada evento a un usuario específico.
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'time',
        'publicado' => 'boolean'
    ];

    // Relación con User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
