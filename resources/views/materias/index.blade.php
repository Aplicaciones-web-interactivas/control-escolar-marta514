@extends('layouts.app')

@section('content')
    <h2>Gestión de Materias</h2>
    

<form action="{{ route('materias.store') }}" method="POST">
    @csrf
    <input type="text" name="clave_materia" placeholder="Clave de materia" required>
    <input type="text" name="nombre" placeholder="Nombre de la materia" required>
    <button type="submit">Agregar Materia</button>
</form>

<hr>

<table border="1">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        @foreach($materias as $materia)
            <tr>
                <td>{{ $materia->clave_materia }}</td>
                <td>{{ $materia->nombre }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection