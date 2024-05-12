<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Autor;

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

    // Asegúrate de que 'LibroID' sea cambiado a 'external_id' si así lo usas en la tabla comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'external_id', 'external_id');
    }

    public function estanterias()
    {
        return $this->belongsToMany(Estanteria::class, 'estanterias_libros', 'libro_id', 'estanteria_id');
    }

    // Corrige la relación de puntuaciones para usar 'external_id'
    public function puntuaciones()
    {
        return $this->hasMany(Puntuacion::class, 'external_id', 'external_id');
    }

    // Método para calcular el promedio de puntuaciones
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
    return $this->hasMany(EstanteriaLibro::class, 'external_id', 'external_id')
                ->where('user_id', $userId)
                ->first();
}

}
