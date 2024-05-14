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
            $table->unsignedBigInteger('user_id');
            $table->string('external_id');
            $table->enum('estado', ['leyendo', 'leidos', 'quieroLeer', 'abandonado', 'sinEstado'])->default('sinEstado');
            $table->timestamps();

            $table->primary(['estanteria_id', 'external_id', 'user_id']);
            $table->foreign('estanteria_id')->references('id')->on('estanterias')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estanterias_libros');
    }
}
?>
