<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        // Paginamos de 10 en 10 y mostramos las últimas creadas primero
        $materias = Materia::latest()->paginate(10);
        return view('materias.index', compact('materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'clave_materia' => 'required|string|max:20|unique:materias,clave_materia',
        ]);

        Materia::create($request->all());

        return back()->with('success', 'Materia registrada correctamente.');
    }
}
