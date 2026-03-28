@extends('layouts.app')

@section('content')
<div class="mb-8">
    <a href="{{ route('tareas.index') }}" class="text-xs font-bold text-azul-claro uppercase hover:text-azul-marino transition">← Volver a tareas</a>
    <h2 class="text-3xl font-black text-azul-marino tracking-tight mt-2">Revision de: {{ $tarea->titulo }}</h2>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full text-left">
        <thead class="bg-azul-marino text-white">
            <tr>
                <th class="p-5 text-xs font-bold uppercase">Alumno</th>
                <th class="p-5 text-xs font-bold uppercase">Fecha de Entrega</th>
                <th class="p-5 text-xs font-bold uppercase text-center">Acción</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($tarea->entregas as $entrega)
                <tr class="hover:bg-gray-50">
                    <td class="p-5 font-bold text-azul-marino">{{ $entrega->user->nombre }}</td>
                    <td class="p-5 text-sm text-gris-escolar">{{ $entrega->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-5 text-center">
                        <a href="{{ asset('storage/' . $entrega->archivo_path) }}" target="_blank" class="bg-azul-claro text-white px-4 py-2 rounded text-xs font-bold hover:bg-azul-marino transition">
                            Ver PDF
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-10 text-center text-gris-escolar italic">Aún no hay entregas para esta tarea.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection