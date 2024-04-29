<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estanterias;
class EstanteriasLibros extends Model
{
    use HasFactory;


    public function libro()
    {
        return $this->belongsTo(Libro::class, 'LibroID');
    }

    public function estanteria()
    {
        return $this->belongsTo(Estanterias::class, 'EstanteriasID');
    }
}
