<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LibroSugerido extends Model
{
    use HasFactory;

    protected $table = 'librosugerido';

    protected $fillable = [
        'titulo',
        'autor',
        'isbn',
        'idioma',
        'recomendacion',
        'user_id',
        'fechaSugerencia'
    ];

    // Relación con User
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
