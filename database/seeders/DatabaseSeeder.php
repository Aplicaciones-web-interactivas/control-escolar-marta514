<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\Grupo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. SEMBRAR USUARIOS
        // Profesor (Admin)
        User::create([
            'nombre' => 'Prof. Rahanne Wriver',
            'clave_institucional' => '101010',
            'password' => Hash::make('123456'),
            'rol' => 'admin',
        ]);

        // Alumno de prueba
        $alumno = User::create([
            'nombre' => 'Juan Pérez Alumno',
            'clave_institucional' => '202020',
            'password' => Hash::make('123456'),
            'rol' => 'alumno',
        ]);

        // 2. SEMBRAR MATERIAS
        $m1 = Materia::create(['clave_materia' => 'MAT101', 'nombre' => 'Cálculo I']);
        $m2 = Materia::create(['clave_materia' => 'PROG202', 'nombre' => 'Laravel Avanzado']);

        // 3. SEMBRAR HORARIOS
        $h1 = Horario::create(['dia' => 'Lunes', 'hora_inicio' => '07:00', 'hora_fin' => '09:00']);
        $h2 = Horario::create(['dia' => 'Miércoles', 'hora_inicio' => '09:00', 'hora_fin' => '11:00']);

        // 4. SEMBRAR GRUPOS (Uniendo Materia + Horario)
        $g1 = Grupo::create([
            'materia_id' => $m1->id,
            'horario_id' => $h1->id,
            'clave_grupo' => 'G-101',
            'aula' => 'Laboratorio A'
        ]);

        $g2 = Grupo::create([
            'materia_id' => $m2->id,
            'horario_id' => $h2->id,
            'clave_grupo' => 'G-202',
            'aula' => 'Salón 15'
        ]);

        // 5. SEMBRAR UNA INSCRIPCIÓN (Opcional: Para que el alumno ya tenga horario)
        // Esto asume que tienes el modelo Inscripcion
        \App\Models\Inscripcion::create([
            'user_id' => $alumno->id,
            'grupo_id' => $g2->id,
        ]);
    }
}