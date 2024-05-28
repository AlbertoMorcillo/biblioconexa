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

    public function puntuacion()
    {
        return $this->hasOne(Puntuacion::class, 'external_id', 'external_id')
                    ->where('user_id', $this->user_id);
    }

    public function getLibroAttribute()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://openlibrary.org/works/' . $this->external_id . '.json');
        $bookDetails = json_decode($response->getBody()->getContents(), true);
        return $bookDetails;
    }
}
