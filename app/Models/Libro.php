<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'titulo',
        'autor',
        'sinopsis',
        'puntuacion',
        'cantidad',
        'portada',
        'categoriaID',
    ];

    public function categoria()
    {

        return $this->belongsTo(Categoria::class, 'categoriaID');
    }

    public function comentarios()
    {
        // Si existe una relación uno a muchos con la tabla 'comentario'
        return $this->hasMany(Comentario::class, 'LibroID');
    }

    public function estanteriasLibros()
    {
        // Si existe una relación uno a muchos con la tabla 'estanteriaslibros'
        return $this->hasMany(EstanteriasLibros::class, 'LibroID');
    }

    public function usuarios()
{
    return $this->belongsToMany(User::class, 'estanterias_libros', 'libro_id', 'user_id')
                ->withPivot('estanteria_id')
                ->withTimestamps();
}
}
