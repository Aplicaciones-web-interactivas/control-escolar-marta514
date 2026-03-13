@extends('layouts.app')

@section('content')
    <h2>Mi Horario Escolar</h2>


<div style="background: #f4f4f4; padding: 15px; border-radius: 8px; margin-bottom: 30px;">
    <h3>Registrar Nueva Clase</h3>
    <form action="{{ route('horarios.store') }}" method="POST">
        @csrf
        
        <div>
            <label>Selecciona Materia:</label>
            <select name="materia_id" required>
                <option value="">-- Selecciona una materia --</option>
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}">{{ $materia->nombre }} ({{ $materia->clave_materia }})</option>
                @endforeach
            </select>
        </div><br>

        <div>
            <label>Hora Inicio:</label>
            <input type="time" name="hora_inicio" required>
            
            <label>Hora Fin:</label>
            <input type="time" name="hora_fin" required>
        </div><br>

        <div>
            <label>Días:</label><br>
            <input type="checkbox" name="dias[]" value="Lunes"> Lunes
            <input type="checkbox" name="dias[]" value="Martes"> Martes
            <input type="checkbox" name="dias[]" value="Miércoles"> Miércoles
            <input type="checkbox" name="dias[]" value="Jueves"> Jueves
            <input type="checkbox" name="dias[]" value="Viernes"> Viernes
        </div><br>

        <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer;">
            Guardar en mi Horario
        </button>
    </form>
</div>

<hr>

<h3>Mis Clases Registradas</h3>
<table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
    <thead style="background: #333; color: white;">
        <tr>
            <th>Materia</th>
            <th>Clave</th>
            <th>Horario</th>
            <th>Días</th>
        </tr>
    </thead>
    <tbody>
        @forelse($horarios as $horario)
            <tr>
                <td>{{ $horario->materia->nombre }}</td>
                <td>{{ $horario->materia->clave_materia }}</td>
                <td>{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</td>
                <td>{{ $horario->dias }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">Aún no tienes materias en tu horario.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection