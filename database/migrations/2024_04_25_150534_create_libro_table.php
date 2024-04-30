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
            $table->text('sinopsis')->nullable();
            $table->decimal('puntuacion', 2, 1)->nullable();
            $table->integer('cantidad');
            $table->string('portada', 255)->nullable();  // Conservamos para casos donde la imagen de Google Books no esté disponible o para caching local
            $table->string('google_book_id')->nullable(); // Almacenar el ID de Google Books
            $table->unsignedBigInteger('categoriaID');
            $table->foreign('categoriaID')->references('id')->on('categoria')->onUpdate('cascade');
            $table->timestamps();
        });

        // Crear tabla de relación libro-autores para manejar múltiples autores
        Schema::create('libro_autores', function (Blueprint $table) {
            $table->unsignedBigInteger('libro_id');
            $table->unsignedBigInteger('autor_id');
            $table->foreign('libro_id')->references('id')->on('libro')->onDelete('cascade');
            $table->foreign('autor_id')->references('id')->on('autores')->onDelete('cascade');
            $table->primary(['libro_id', 'autor_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('libro_autores');
        Schema::dropIfExists('libro');
    }
}

