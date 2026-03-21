@extends('layouts.app')

@section('content')
    <h2>Inscripción de Alumnos a Grupos</h2>

    @if($errors->any())
        <div style="color: red;">{{ $errors->first() }}</div>
    @endif

    <div style="background: #f4f4f4; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
        <form action="{{ route('inscripciones.store') }}" method="POST">
            @csrf
            <label>Seleccionar Alumno:</label>
            <select name="user_id" required>
                @foreach($usuarios as $user)
                    <option value="{{ $user->id }}">{{ $user->nombre }} ({{ $user->clave_institucional }})</option>
                @endforeach
            </select>

            <label>Seleccionar Grupo:</label>
            <select name="grupo_id" required>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}">
                        {{ $grupo->nombre }} - {{ $grupo->horario->materia->nombre }}
                    </option>
                @endforeach
            </select>

            <button type="submit" style="background: #007bff; color: white; padding: 5px 15px; border: none; cursor: pointer;">
                Inscribir
            </button>
        </form>
    </div>

    <table border="1" width="100%" style="border-collapse: collapse;">
        <thead>
            <tr style="background: #eee;">
                <th>Alumno</th>
                <th>Grupo</th>
                <th>Materia</th>
                <th>Fecha de Inscripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inscripciones as $inscripcion)
                <tr>
                    <td>{{ $inscripcion->usuario->nombre }}</td>
                    <td>{{ $inscripcion->grupo->nombre }}</td>
                    <td>{{ $inscripcion->grupo->horario->materia->nombre }}</td>
                    <td>{{ $inscripcion->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection