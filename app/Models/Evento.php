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
        'user_id'
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'time'
    ];

    public function usuario()
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
