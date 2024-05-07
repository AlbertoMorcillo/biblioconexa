<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroTable extends Migration
{
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 13)->unique()->nullable(); // Asegúrate de que realmente quieres esto como nullable
            $table->string('titulo', 255);
            $table->text('sinopsis')->nullable();
            $table->decimal('puntuacion', 2, 1)->nullable();
            $table->integer('cantidad')->default(0);
            $table->string('portada', 255)->nullable();
            $table->string('external_id')->unique();
            $table->unsignedBigInteger('categoriaID')->nullable();
            $table->foreign('categoriaID')->references('id')->on('categoria')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
