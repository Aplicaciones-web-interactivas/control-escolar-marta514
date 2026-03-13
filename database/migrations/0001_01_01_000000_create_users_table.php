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
    Schema::create('users', function (Blueprint $table) {
        $table->id(); // ID autoincremental de la DB
        $table->string('nombre');
        $table->string('clave_institucional', 6)->unique(); // Los 6 números
        $table->string('password');
        $table->string('rol')->default('usuario');
        $table->timestamps();
    });
}
};
