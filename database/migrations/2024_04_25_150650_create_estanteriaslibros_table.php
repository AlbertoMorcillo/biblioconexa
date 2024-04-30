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
            $table->unsignedBigInteger('libro_id');
            $table->timestamps();  // Para registrar cuándo se añadió un libro a una estantería

            $table->primary(['estanteria_id', 'libro_id']);
            $table->foreign('estanteria_id')->references('id')->on('estanterias')->onDelete('cascade');
            $table->foreign('libro_id')->references('id')->on('libro')->onDelete('cascade');
        });
    }

    public function down()
    {
        
        Schema::dropIfExists('estanterias_libros');
    }
}
