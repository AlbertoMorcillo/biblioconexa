<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Clave primaria autoincremental
            $table->string('dni', 9)->unique();  // DNI como campo único
            $table->string('name');
            $table->string('surname')->nullable();  // Apellido, opcional
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();  // Teléfono, opcional
            $table->date('birthdate')->nullable();  // Fecha de nacimiento, opcional
            $table->rememberToken();
            $table->tinyInteger('isAdmin')->default(0);  // Campo para determinar si el usuario es administrador
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

