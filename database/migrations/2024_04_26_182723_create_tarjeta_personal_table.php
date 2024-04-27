<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('tarjeta_personal', function (Blueprint $table) {
            $table->id();
            $table->string('user_dni', 9)->nullable()->unique(); 
            $table->enum('genero', ['Hombre', 'Mujer', 'No binario', 'Privado']);
            $table->date('fecha_nacimiento');
            $table->string('nombre');
            $table->string('primer_apellido');
            $table->string('segundo_apellido');
            $table->string('correo_electronico');
            $table->string('telefono');
            $table->timestamps();

            $table->foreign('user_dni')->references('dni')->on('users')
                  ->onDelete('set null') // Si se borra el usuario, la referencia se pone en null
                  ->onUpdate('cascade'); // Si se actualiza el DNI del usuario, se actualiza aquí también
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjeta_personal');
    }
};

