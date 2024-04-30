<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    // Relación con libros
    public function libros()
    {
        return $this->hasMany(Libro::class, 'categoriaID');
    }
}
