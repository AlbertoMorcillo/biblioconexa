<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstanteriaslibrosTable extends Migration
{
    public function up()
    {
        Schema::create('estanteriaslibros', function (Blueprint $table) {
            $table->unsignedBigInteger('EstanteriasID');
            $table->unsignedBigInteger('LibroID');
            $table->primary(['EstanteriasID', 'LibroID']);
            $table->foreign('EstanteriasID')->references('id')->on('estanterias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('LibroID')->references('id')->on('libro')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estanteriaslibros');
    }
}
