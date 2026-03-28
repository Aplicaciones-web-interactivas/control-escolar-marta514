@extends('layouts.app')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h2 class="text-3xl font-black text-azul-marino tracking-tight">Mis Calificaciones</h2>
        <p class="text-azul-claro text-sm italic">Historial académico del alumno</p>
    </div>
    <div class="bg-f5f6f3 border border-gray-200 p-4 rounded-xl text-center">
        <span class="block text-xs uppercase font-bold text-gris-escolar">Estatus</span>
        <span class="text-cafe-acento font-black text-xl">REGULAR</span>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-azul-marino text-white">
                <th class="p-5 text-sm font-bold uppercase tracking-widest">Materia</th>
                <th class="p-5 text-sm font-bold uppercase tracking-widest">Grupo</th>
                <th class="p-5 text-sm font-bold uppercase tracking-widest text-center">Calificación</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($calificaciones as $cal)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="p-5">
                        <div class="font-bold text-azul-marino">
                            {{ $cal->grupo->horario->materia->nombre }}
                        </div>
                        <div class="text-xs text-gris-escolar italic">Clave: {{ $cal->grupo->horario->materia->clave_materia }}</div>
                    </td>
                    <td class="p-5">
                        <span class="bg-azul-claro/10 text-azul-claro px-3 py-1 rounded-full text-xs font-bold">
                            {{ $cal->grupo->nombre }}
                        </span>
                    </td>
                    <td class="p-5 text-center">
                        <span class="text-xl font-black {{ $cal->calificacion >= 6 ? 'text-cafe-acento' : 'text-red-500' }}">
                            {{ number_format($cal->calificacion, 1) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-10 text-center text-gris-escolar italic">
                        No se han registrado calificaciones todavía.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6 flex gap-4 text-xs text-gris-escolar items-center">
    <div class="flex items-center gap-1">
        <div class="w-3 h-3 bg-cafe-acento rounded"></div> Materia Aprobada
    </div>
    <div class="flex items-center gap-1">
        <div class="w-3 h-3 bg-red-500 rounded"></div> Materia Reprobada
    </div>
</div>
@endsection