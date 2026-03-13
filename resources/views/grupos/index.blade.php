@extends('layouts.app')

@section('content')
    <h2>Gestión de Grupos</h2>

    <div style="background: #f4f4f4; padding: 15px; margin-bottom: 20px;">
        <form action="{{ route('grupos.store') }}" method="POST">
            @csrf
            <input type="text" name="nombre" placeholder="Nombre del Grupo (ej: 1A)" required>
            
            <select name="horario_id" required>
                <option value="">-- Asignar Horario --</option>
                @foreach($horarios as $horario)
                    <option value="{{ $horario->id }}">
                        {{ $horario->materia->nombre }} | {{ $horario->dias }} ({{ $horario->hora_inicio }})
                    </option>
                @endforeach
            </select>
            
            <button type="submit">Crear Grupo</button>
        </form>
    </div>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Nombre del Grupo</th>
                <th>Materia Asignada</th>
                <th>Horario y Días</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->nombre }}</td>
                    <td>{{ $grupo->horario->materia->nombre }}</td>
                    <td>{{ $grupo->horario->dias }} de {{ $grupo->horario->hora_inicio }} a {{ $grupo->horario->hora_fin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection