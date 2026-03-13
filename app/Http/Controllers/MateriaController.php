<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    // Mostrar la lista y el formulario
    public function index() {
        $materias = Materia::all();
        return view('materias.index', compact('materias'));
    }

    // Guardar la materia
    public function store(Request $request) {
        $request->validate([
            'clave_materia' => 'required|unique:materias|max:10',
            'nombre' => 'required|string|max:100',
        ]);

        Materia::create($request->all());

        return back()->with('success', 'Materia registrada correctamente.');
    }
}
