<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Usuarios existentes
        DB::table('users')->insert([
            [
                'dni' => '47276750C',
                'name' => 'Alberto',
                'surname' => null,
                'email' => 'a.morcillo@sapalomera.cat',
                'email_verified_at' => now(),
                'password' => Hash::make('P@ssw0rd'), 
                'phone' => 634797322,
                'birthdate' => null,
                'remember_token' => Str::random(10),
                'isAdmin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Otros usuarios aquí si es necesario
        ]);

        // Administradores
        DB::table('users')->insert([
            [
                'dni' => '32311965R',
                'name' => 'Elinor',
                'surname' => 'Caskey',
                'email' => 'elinor@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('p@ssw0rd'),
                'phone' => '123456789',
                'birthdate' => '1990-01-01',
                'remember_token' => Str::random(10),
                'isAdmin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dni' => '36776804B',
                'name' => 'Mondongo',
                'surname' => 'Cangrejo',
                'email' => 'mondongo@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('P@ssw0rd'),
                'phone' => '123456789',
                'birthdate' => '1993-01-01',
                'remember_token' => Str::random(10),
                'isAdmin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
