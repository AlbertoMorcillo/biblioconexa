<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';

    protected $fillable = [
        'nombre', 'fecha_de_nacimiento', 'fecha_de_fallecimiento', 'lugar_de_nacimiento', 'nacionalidad', 'biografia', 'imagen'
    ];

    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'libro_autores', 'autor_id', 'libro_id');
    }
}
