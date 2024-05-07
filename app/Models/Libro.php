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
        'isbn', 'titulo', 'sinopsis', 'puntuacion', 'cantidad', 'portada', 'external_id', 'categoriaID'
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
        return $this->hasMany(Comentario::class, 'LibroID');
    }

    public function estanterias()
    {
        return $this->belongsToMany(Estanteria::class, 'estanterias_libros', 'libro_id', 'estanteria_id');
    }
}
