@extends('layouts.app')

@section('content')
    <h2>Mis Calificaciones</h2>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Materia</th>
                <th>Grupo</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calificaciones as $cal)
                <tr>
                    <td>{{ $cal->grupo->horario->materia->nombre }}</td>
                    <td>{{ $cal->grupo->nombre }}</td>
                    <td><strong>{{ $cal->calificacion }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection