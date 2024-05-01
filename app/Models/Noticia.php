<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Noticia extends Model
{
    use HasFactory;

    // Lista de propiedades que se pueden asignar masivamente
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'publicado',
        'imagen',
        'user_id' // Asegúrate de que user_id es asignable masivamente si es que se usará en formularios
    ];

    // Casts para convertir los tipos de datos de las propiedades
    protected $casts = [
        'fecha' => 'date',
        'publicado' => 'boolean'
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
