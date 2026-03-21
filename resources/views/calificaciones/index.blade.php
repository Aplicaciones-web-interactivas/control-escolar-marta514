@extends('layouts.app')

@section('content')
    <h2>Registro de Calificaciones</h2>

    <div style="background: #f9f9f9; padding: 15px; border: 1px solid #ddd; margin-bottom: 20px;">
        <form action="{{ route('calificaciones.store') }}" method="POST">
    @csrf
    <label>Alumno e Inscripción:</label>
    <select name="user_id_grupo_id" required>
        <option value="">-- Selecciona Alumno y su Grupo --</option>
        @foreach($usuarios as $user)
            @foreach($user->inscripciones as $inscripcion)
                <option value="{{ $user->id }}|{{ $inscripcion->grupo->id }}">
                    {{ $user->nombre }} -> {{ $inscripcion->grupo->nombre }} ({{ $inscripcion->grupo->horario->materia->nombre }})
                </option>
            @endforeach
        @endforeach
    </select>

    <input type="number" name="calificacion" step="0.1" min="0" max="10" placeholder="0.0" required>
    <button type="submit">Asignar Calificación</button>
</form>
    </div>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Alumno</th>
                <th>Grupo</th>
                <th>Materia</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calificaciones as $cal)
                <tr>
                    <td>{{ $cal->usuario->nombre }}</td>
                    <td>{{ $cal->grupo->nombre }}</td>
                    <td>{{ $cal->grupo->horario->materia->nombre }}</td>
                    <td><strong>{{ $cal->calificacion }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection