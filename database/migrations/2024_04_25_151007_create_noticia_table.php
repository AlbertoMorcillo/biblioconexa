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
            $table->unsignedBigInteger('user_id')->nullable(); // Usamos el ID del usuario
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->date('fecha');
            $table->boolean('publicado')->default(false);
            $table->string('imagen')->nullable();
            $table->string('UsuarioDNI', 9);
            $table->foreign('user_id')->references('id')->on('users') // Referencia al ID del usuario
            ->onDelete('set null')
            ->onUpdate('cascade'); 
            $table->timestamps();
            $table->index('fecha'); //Sirve para acelerar las consultas que filtran por fecha
            $table->index('publicado');
        });
    }

    public function down()
    {
        Schema::dropIfExists('noticia');
    }
}
