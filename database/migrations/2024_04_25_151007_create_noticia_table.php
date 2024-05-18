<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaTable extends Migration
{
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->datetime('fecha');
            $table->string('imagen')->nullable();
            $table->string('UsuarioDNI', 9);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index('fecha');
        });
    }

    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
