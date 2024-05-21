<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'titulo' => 'Nueva Biblioteca Abierta en el Centro de la Ciudad',
                'descripcion' => 'La nueva biblioteca en el centro de la ciudad ha sido inaugurada hoy. Con una gran variedad de libros y recursos disponibles para el público, esta biblioteca promete ser un punto de encuentro para todos los amantes de la lectura.',
                'fecha' => Carbon::now(),
                'imagen' => 'images/admin/noticias.jpg',
                'UsuarioDNI' => '32311965R',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userId,
                'titulo' => 'Taller de Escritura Creativa',
                'descripcion' => 'La biblioteca ofrecerá un taller de escritura creativa el próximo mes. Este taller está diseñado para ayudar a los escritores a mejorar sus habilidades y encontrar su propia voz en la escritura.',
                'fecha' => Carbon::now()->addDays(10),
                'imagen' => 'images/admin/noticias.jpg',
                'UsuarioDNI' => '32311965R',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $userId,
                'titulo' => 'Club de Lectura: Novelas Clásicas',
                'descripcion' => 'Únete a nuestro club de lectura donde discutiremos algunas de las novelas clásicas más influyentes de todos los tiempos. Las reuniones serán mensuales y están abiertas a todos los miembros de la comunidad.',
                'fecha' => Carbon::now()->addDays(20),
                'imagen' => 'images/admin/noticias.jpg',
                'UsuarioDNI' => '32311965R',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insertar las noticias en la base de datos
        DB::table('noticias')->insert($noticias);
    }
}
