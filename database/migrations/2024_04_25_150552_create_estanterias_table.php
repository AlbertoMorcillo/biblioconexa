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
            $table->unsignedBigInteger('user_id'); // Clave foránea del usuario
            $table->string('nombre', 255); // Nombre de la estantería, que puede ser personalizado
            $table->enum('estado', ['leyendo', 'leidos', 'quieroLeer', 'abandonado', 'sinEstado'])->default('sinEstado'); // Estado predeterminado

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estanterias');
    }
}


