<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class NoticiasSeeder extends Seeder
{
    public function run()
    {
        // ID del usuario Elinor
        $userId = 2;

        // Noticias a insertar
        $noticias = [
            [
                'user_id' => $userId,
                'titulo' => 'Noticia 1',
                'descripcion' => 'Descripción de la noticia 1',
                'fecha' => Carbon::now(),
                'imagen' => 'noticias/imagen1.jpg',
                'UsuarioDNI' => '32311965R',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userId,
                'titulo' => 'Noticia 2',
                'descripcion' => 'Descripción de la noticia 2',
                'fecha' => Carbon::now(),
                'imagen' => 'noticias/imagen2.jpg',
                'UsuarioDNI' => '32311965R',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userId,
                'titulo' => 'Noticia 3',
                'descripcion' => 'Descripción de la noticia 3',
                'fecha' => Carbon::now(),
                'imagen' => 'noticias/imagen3.jpg',
                'UsuarioDNI' => '32311965R',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insertar las noticias en la base de datos
        DB::table('noticias')->insert($noticias);
    }
}
