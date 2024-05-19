<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'imagen',
        'user_id',
        'UsuarioDNI'
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    /**
     * Relación Usuario-Noticia: cada noticia pertenece a un usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope para ordenar las noticias por fecha.
     *
     * @param Builder $query
     * @param string $orden 'most-recent' para los más recientes primero, 'oldest-first' para los más antiguos primero
     * @return Builder
     */
    public function scopeOrdenarPorFecha(Builder $query, $orden = 'most-recent')
    {
        if ($orden == 'most-recent') {
            return $query->orderBy('fecha', 'desc');
        } else {
            return $query->orderBy('fecha', 'asc');
        }
    }
}
