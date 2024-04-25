<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosugeridoTable extends Migration
{
    public function up()
    {
        Schema::create('librosugerido', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255)->nullable();
            $table->string('autor', 255)->nullable();
            $table->string('isbn', 13)->nullable();
            $table->string('idioma', 50)->nullable();
            $table->text('recomendacion')->nullable();
            $table->string('UsuarioDNI', 9);
            $table->foreign('UsuarioDNI')->references('dni')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('fechaSugerencia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('librosugerido');
    }
}
