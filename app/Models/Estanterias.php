<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Libro;
use App\Models\EstanteriasLibros;

class Estanterias extends Model
{
    use HasFactory;

    protected $fillable = ['UsuarioDNI', 'Estado'];

    // Relación con el usuario propietario de la estantería
    public function user()
    {
        return $this->belongsTo(User::class, 'UsuarioDNI', 'dni');
    }

    // Relación con los libros a través de la tabla intermedia
    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'estanterias_libros', 'estanteria_id', 'libro_id')
                    ->withPivot('user_id')
                    ->withTimestamps();
    }
    // Acceso directo a la tabla intermedia si es necesario
    public function estanteriasLibros()
    {
        return $this->hasMany(EstanteriasLibros::class, 'EstanteriasID');
    }
}
