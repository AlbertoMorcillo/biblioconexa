<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioTable extends Migration
{
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('external_id');  // Cambiado para almacenar el ID externo de Open Library
            $table->text('texto');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // No hay necesidad de una clave foránea hacia la tabla 'libro'
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
