<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tarea_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // El Alumno
            $table->string('archivo_path'); // Aquí guardaremos la ruta del PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};