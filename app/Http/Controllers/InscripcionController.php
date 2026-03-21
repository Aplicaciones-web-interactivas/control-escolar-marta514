<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\User;
use App\Models\Grupo;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index() {
        // Obtenemos todas las inscripciones para listarlas
        $inscripciones = Inscripcion::with(['usuario', 'grupo.horario.materia'])->get();
        
        // Datos para los select del formulario
        $usuarios = User::all();
        $grupos = Grupo::with('horario.materia')->get();
        
        return view('inscripciones.index', compact('inscripciones', 'usuarios', 'grupos'));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        // Evitar duplicados (que un alumno se inscriba dos veces al mismo grupo)
        $existe = Inscripcion::where('user_id', $request->user_id)
                             ->where('grupo_id', $request->grupo_id)
                             ->exists();

        if ($existe) {
            return back()->withErrors(['mensaje' => 'El alumno ya está inscrito en este grupo.']);
        }

        Inscripcion::create($request->all());

        return back()->with('success', 'Alumno inscrito correctamente.');
    }
}
