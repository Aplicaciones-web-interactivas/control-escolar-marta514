<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Entrega;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TareaController extends Controller
{
    // MAESTRO: Ver y crear tareas
    public function index() {
        $user = auth()->user();

        // 1. Si es Administrador/Maestro, ve absolutamente todo
        if ($user->rol === 'admin') {
            $grupos = \App\Models\Grupo::with('horario.materia')->get();
            $tareas = \App\Models\Tarea::with(['grupo.horario.materia', 'entregas'])
                           ->latest()
                           ->paginate(10);
        } 
        // 2. Si es Alumno, filtramos estrictamente
        else {
            $grupos = collect(); // El alumno no ocupa la lista de grupos
            
            // MÉTODO A PRUEBA DE BALAS: Buscamos directamente en la tabla inscripciones
            // los grupos que le pertenecen al ID de este usuario en específico.
            $misGruposIds = \App\Models\Inscripcion::where('user_id', $user->id)->pluck('grupo_id');
            
            // Si $misGruposIds está vacío (no tiene inscripciones), whereIn devolverá 0 tareas.
            $tareas = \App\Models\Tarea::whereIn('grupo_id', $misGruposIds)
                           ->with(['grupo.horario.materia', 'entregas'])
                           ->latest()
                           ->paginate(10);
        }

        return view('tareas.index', compact('tareas', 'grupos'));
    }

    public function verEntregas(Tarea $tarea) {
    $tarea->load('entregas.user');
    return view('tareas.ver_entregas', compact('tarea'));
}

    public function store(Request $request) {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'fecha_entrega' => 'required|date',
        ]);
        Tarea::create($request->all());
        return back()->with('success', 'Tarea asignada.');
    }

    // ALUMNO: Subir PDF
    public function subirEntrega(Request $request, Tarea $tarea) {
        $request->validate([
            'archivo' => 'required|mimes:pdf|max:2048', // Solo PDF, máx 2MB
        ]);

        $path = $request->file('archivo')->store('entregas', 'public');

        Entrega::updateOrCreate(
            ['tarea_id' => $tarea->id, 'user_id' => auth()->id()],
            ['archivo_path' => $path]
        );

        return back()->with('success', 'Tarea entregada correctamente.');
    }
}