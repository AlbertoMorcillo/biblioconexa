<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventoTable extends Migration
{
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->date('fecha');
            $table->time('hora');
            $table->string('sala', 255)->nullable();
            $table->string('UsuarioDNI', 9);
            $table->foreign('UsuarioDNI')->references('dni')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evento');
    }
}

