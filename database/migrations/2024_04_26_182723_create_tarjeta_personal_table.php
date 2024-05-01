<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarjeta_personal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Usamos el ID del usuario
            $table->enum('genero', ['Hombre', 'Mujer', 'No binario', 'Privado']);
            $table->date('fecha_nacimiento');
            $table->string('nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('correo_electronico');
            $table->string('telefono');
            $table->string('dni', 9); // Añade esta línea para el DNI
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users') // Referencia al ID del usuario
                  ->onDelete('set null') // Si se borra el usuario, la referencia se pone en null
                  ->onUpdate('cascade'); // Si se actualiza el ID del usuario, se actualiza aquí también
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarjeta_personal');
    }
};