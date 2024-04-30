<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estanteria;
class EstanteriaLibro extends Model
{
    use HasFactory;

    protected $table = 'estanterias_libros'; // Aunque la tabla está en plural, el modelo es singular

    protected $fillable = ['estanteria_id', 'libro_id'];

    public function estanteria()
    {
        return $this->belongsTo(Estanteria::class, 'estanteria_id'); // Asumiendo que el modelo de estanterías también sigue esta convención
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id'); // Igual aquí
    }
}

