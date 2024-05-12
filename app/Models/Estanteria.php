<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estanteria extends Model
{
    use HasFactory;

    protected $table = 'estanterias';

    protected $fillable = ['user_id', 'nombre'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'estanterias_libros', 'estanteria_id', 'libro_id')
                    ->withTimestamps(); // Esta relación también podría incluir el manejo del estado si es necesario
    }
}
