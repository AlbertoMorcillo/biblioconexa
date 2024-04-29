<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'UsuarioDNI',
        'LibroID',
        'texto',
        'fechaCreacion'
    ];

    public function libro()
    {

        return $this->belongsTo(Libro::class, 'LibroID');
    }

    public function usuario()
    {
    
        return $this->belongsTo(User::class, 'UsuarioDNI', 'dni');
    }
}
