<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioTable extends Migration
{
    public function up()
    {

        Schema::create('comentario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index(); // Usamos el ID del usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('LibroID')->index();
            $table->foreign('LibroID')->references('id')->on('libro')->onDelete('cascade')->onUpdate('cascade');
            $table->text('texto');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentario');
    }
}
