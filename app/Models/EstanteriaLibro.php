<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstanteriaLibro extends Model
{
    use HasFactory;

    protected $table = 'estanterias_libros';

    protected $fillable = ['estanteria_id', 'external_id', 'estado'];

    public function estanteria()
    {
        return $this->belongsTo(Estanteria::class, 'estanteria_id');
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'external_id');
    }
}
