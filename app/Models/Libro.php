<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Libro extends Model
{
    use HasFactory;

    protected $table = 'libros';
    protected $fillable = [
        'isbn', 'titulo', 'sinopsis', 'cantidad', 'portada', 'external_id', 'categoriaID'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoriaID');
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'libro_autores', 'libro_id', 'autor_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'external_id', 'external_id');
    }

    public function estanterias()
    {
        return $this->belongsToMany(Estanteria::class, 'estanterias_libros', 'external_id', 'estanteria_id')
                    ->withPivot('user_id', 'estado');
    }

    public function puntuaciones()
    {
        return $this->hasMany(Puntuacion::class, 'external_id', 'external_id');
    }

    public function promedioPuntuacion()
    {
        return $this->puntuaciones()->avg('puntuacion');
    }

    public function puntuacionDeUsuario($userId)
    {
        return $this->hasOne(Puntuacion::class, 'external_id', 'external_id')
            ->where('user_id', $userId)
            ->first();
    }

    public function estadoParaUsuario($userId)
    {
        return $this->hasOne(EstanteriaLibro::class, 'external_id', 'external_id')
            ->where('user_id', $userId)
            ->first();
    }

    public function estanteriaLibros()
    {
        return $this->hasMany(EstanteriaLibro::class, 'external_id', 'external_id');
    }
    
}
