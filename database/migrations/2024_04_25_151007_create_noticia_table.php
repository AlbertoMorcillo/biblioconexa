<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaTable extends Migration
{
    public function up()
    {
        Schema::create('noticia', function (Blueprint $table) {
            $table->id();
            // Define user_id correctamente con una referencia a la tabla users y que pueda ser nulo
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->date('fecha');
            $table->boolean('publicado')->default(false);
            $table->string('imagen')->nullable();
            $table->string('UsuarioDNI', 9);

            $table->timestamps();
            $table->index('fecha'); // Acelera las consultas que filtran por fecha
            $table->index('publicado'); // Acelera las consultas que filtran por el estado de publicación
        });
    }

    public function down()
    {
        Schema::dropIfExists('noticia');
    }
}

