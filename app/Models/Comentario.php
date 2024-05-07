<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'external_id', 'texto'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
