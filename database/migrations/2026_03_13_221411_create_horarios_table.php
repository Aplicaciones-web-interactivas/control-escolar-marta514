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
    Schema::create('horarios', function (Blueprint $table) {
        $table->id();
        
        // Llaves foráneas
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('materia_id')->constrained()->onDelete('cascade');
        
        // Campos de tiempo
        $table->time('hora_inicio');
        $table->time('hora_fin');
        
        // Días (puedes guardarlo como string, ej: "Lunes, Miércoles")
        $table->string('dias'); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
