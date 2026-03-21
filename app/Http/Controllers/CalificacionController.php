<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    // VISTA ALUMNO: Solo ve sus propias notas
    public function misCalificaciones() {
        $calificaciones = Calificacion::where('user_id', auth()->id())
            ->with(['grupo.horario.materia'])
            ->get();
        
        return view('calificaciones.alumno', compact('calificaciones'));
    }

    // VISTA ADMIN/GESTIÓN: Ve todas y tiene el formulario
    public function gestion() {
    $calificaciones = Calificacion::with(['usuario', 'grupo.horario.materia'])->get();
    
    // Traemos a los usuarios con sus inscripciones y los grupos de esas inscripciones
    $usuarios = User::with('inscripciones.grupo.horario.materia')->get();
    
    return view('calificaciones.index', compact('calificaciones', 'usuarios'));
}

   public function store(Request $request) {
    // Separamos el ID de usuario y el ID de grupo
    $datos = explode('|', $request->user_id_grupo_id);
    $userId = $datos[0];
    $grupoId = $datos[1];

    Calificacion::create([
        'user_id' => $userId,
        'grupo_id' => $grupoId,
        'calificacion' => $request->calificacion,
    ]);

    return back()->with('success', 'Calificación asignada correctamente.');
}
}
