<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstanteriasLibrosTable extends Migration
{
    public function up()
    {
        Schema::create('estanterias_libros', function (Blueprint $table) {
            $table->unsignedBigInteger('estanteria_id');
            $table->string('external_id');  // Cambio de libro_id a external_id
            $table->enum('estado', ['leyendo', 'leidos', 'quieroLeer', 'abandonado', 'sinEstado'])->default('sinEstado'); // Estado de cada libro en la estantería

            $table->timestamps(); // Para registrar cuándo se añadió un libro a una estantería y cuándo se actualizó su estado

            $table->primary(['estanteria_id', 'external_id']); // Llave primaria compuesta, ajustada para external_id
            $table->foreign('estanteria_id')->references('id')->on('estanterias')->onDelete('cascade');
            // No hay clave foránea para external_id ya que es un identificador externo
        });
    }

    public function down()
    {
        Schema::dropIfExists('estanterias_libros');
    }
}
