<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstanteriasTable extends Migration
{
    public function up()
    {
        Schema::create('estanterias', function (Blueprint $table) {
            $table->id();
            $table->string('UsuarioDNI', 9);
            $table->foreign('UsuarioDNI')->references('dni')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('Estado', ['leyendo','leidos','quieroLeer','dropped']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estanterias');
    }
}

