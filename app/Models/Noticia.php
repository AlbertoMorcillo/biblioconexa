<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Noticia extends Model
{
    use HasFactory;


    // Especifica la tabla si es diferente del nombre del modelo en plural
    protected $table = 'noticias';

    // Proporciona un array de campos que puedes asignar masivamente.
    protected $fillable = [
        'titulo',
        'descripcion',
        'fecha',
        'UsuarioDNI', 
    ];

    // Si deseas trabajar con fechas, especifica qué campos son de tipo fecha
    protected $dates = [
        'fecha',
        'created_at',
        'updated_at',
    ];

    // Relaciona la noticia con el usuario que la publicó
    public function usuario()
    {
        return $this->belongsTo(User::class, 'UsuarioDNI', 'dni');
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
