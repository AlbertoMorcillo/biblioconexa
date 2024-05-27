<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        'user_id',
        'imagen'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'publicado' => 'boolean'
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeOrdenarPorFecha(Builder $query, $orden = 'most-recent')
    {
        if ($orden == 'most-recent') {
            return $query->orderBy('fecha', 'desc');
        } else {
            return $query->orderBy('fecha', 'asc');
        }
    }
}
