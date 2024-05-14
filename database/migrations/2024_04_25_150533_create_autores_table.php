<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->index();
            $table->date('fecha_de_nacimiento')->nullable();
            $table->date('fecha_de_fallecimiento')->nullable();
            $table->string('lugar_de_nacimiento', 255)->nullable();
            $table->string('nacionalidad', 100)->nullable();
            $table->text('biografia')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autores');
    }
};
?>
