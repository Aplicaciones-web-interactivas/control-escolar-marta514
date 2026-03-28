<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\User;
use App\Models\Grupo;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index() {
        // 1. Paginamos las inscripciones (10 por página)
        // Usamos latest() para que las inscripciones más nuevas aparezcan primero
        $inscripciones = Inscripcion::with(['usuario', 'grupo.horario.materia'])
                                    ->latest()
                                    ->paginate(10);
        
        // 2. Datos para los select del formulario (estos se quedan con all/get)
        // Solo traemos usuarios con rol 'alumno' para no inscribir administradores por error
        $usuarios = User::where('rol', 'alumno')->get();
        $grupos = Grupo::with('horario.materia')->get();
        
        return view('inscripciones.index', compact('inscripciones', 'usuarios', 'grupos'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        // Evitar duplicados
        $existe = Inscripcion::where('user_id', $request->user_id)
                             ->where('grupo_id', $request->grupo_id)
                             ->exists();

        if ($existe) {
            return back()->withErrors(['mensaje' => 'El alumno ya está inscrito en este grupo.']);
        }

        Inscripcion::create($request->all());

        return back()->with('success', 'Alumno inscrito correctamente.');
    }

    public function misHorarios()
    {
        // En la vista personal del alumno, normalmente no paginamos 
        // porque un alumno no suele tener más de 10 materias por semestre.
        $inscripciones = auth()->user()->inscripciones()
            ->with(['grupo.horario.materia'])
            ->get();

        return view('horarios.horarios', compact('inscripciones'));
    }
}