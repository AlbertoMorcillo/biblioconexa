<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estanteria extends Model
{
    use HasFactory;

    protected $table = 'estanterias'; // Define el nombre de la tabla del modelo

    protected $fillable = [
        'user_id', 'nombre', 'estado' // Propiedades asignables masivamente
    ];

    // Relación con el usuario (cada estantería pertenece a un usuario)
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con los libros (muchos a muchos)
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'estanterias_libros', 'estanteria_id', 'libro_id')
                    ->withTimestamps(); // Manteniendo registros de las fechas de creación y actualización
    }
}
