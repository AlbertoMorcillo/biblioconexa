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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('titulo', 255);
            $table->text('descripcion');
            $table->date('fecha');
            $table->time('hora');
            $table->string('sala', 255)->nullable();
            $table->string('UsuarioDNI', 9);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
?>
