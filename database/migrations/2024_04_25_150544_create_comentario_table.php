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
            $table->string('UsuarioDNI', 9);
            $table->foreign('UsuarioDNI')->references('dni')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('LibroID');
            $table->foreign('LibroID')->references('id')->on('libro')->onDelete('cascade')->onUpdate('cascade');
            $table->text('texto');
            $table->dateTime('fechaCreacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentario');
    }
}
