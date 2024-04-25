<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroTable extends Migration
{
    public function up()
    {
        Schema::create('libro', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 13)->unique();
            $table->string('titulo', 255);
            $table->string('autor', 255);
            $table->text('sinopsis')->nullable();
            $table->decimal('puntuacion', 2, 1)->nullable();
            $table->integer('cantidad');
            $table->string('portada', 255)->nullable();
            $table->unsignedBigInteger('categoriaID');
            $table->foreign('categoriaID')->references('id')->on('categoria')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libro');
    }
}
