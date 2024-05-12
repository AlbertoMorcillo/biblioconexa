<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntuacionesTable extends Migration
{
    public function up()
    {
        Schema::create('puntuaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('external_id');  // Cambiado a string para manejar IDs como texto
            $table->decimal('puntuacion', 2, 1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['external_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('puntuaciones');
    }
}
