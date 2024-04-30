<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Estanterias;
class EstanteriasLibros extends Model
{
    use HasFactory;

    // Define la relación de vuelta hacia la estantería
    public function estanteria()
    {
        return $this->belongsTo(Estanterias::class);
    }
    
    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

