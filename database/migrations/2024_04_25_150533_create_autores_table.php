<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autores', function (Blueprint $table) {
            $table->id();  // Clave primaria
            $table->string('nombre', 255)->index();  // Nombre del autor con índice para búsquedas más rápidas
            $table->date('fecha_de_nacimiento')->nullable();  // Fecha de nacimiento del autor
            $table->date('fecha_de_fallecimiento')->nullable();  // Fecha de fallecimiento del autor
            $table->string('lugar_de_nacimiento', 255)->nullable();  // Lugar de nacimiento del autor
            $table->string('nacionalidad', 100)->nullable();  // Nacionalidad del autor
            $table->text('biografia')->nullable();  // Biografía opcional del autor
            $table->string('imagen', 255)->nullable();  // URL de una imagen del autor
            $table->timestamps();  // Marcas de tiempo para created_at y updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autores');
    }
};

