@extends('layouts.app')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight">Catálogo de Materias</h2>
    <p class="text-azul-claro text-sm italic">Administra la oferta académica de la institución</p>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-10">
    <div class="bg-azul-marino p-4">
        <h3 class="text-white font-bold text-xs uppercase tracking-widest flex items-center gap-2">
            <span class="w-2 h-2 bg-cafe-acento rounded-full"></span>
            Nueva Asignatura
        </h3>
    </div>
    
    <div class="p-8 bg-gray-50/50">
        <form action="{{ route('materias.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
            @csrf
            
            <div class="md:col-span-1">
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Nombre de la Materia</label>
                <input type="text" name="nombre" placeholder="Ej. Estructuras de Datos" required
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm">
            </div>

            <div>
                <label class="block text-xs font-bold text-azul-marino uppercase mb-2">Clave Única</label>
                <input type="text" name="clave_materia" placeholder="Ej. EST-102" required
                    class="w-full p-3 bg-white border border-gray-300 rounded-xl focus:ring-2 focus:ring-cafe-acento outline-none transition text-sm font-mono uppercase">
            </div>

            <button type="submit" 
                class="bg-cafe-acento hover:bg-azul-marino text-white font-bold py-3 px-6 rounded-xl shadow-md transition-all duration-300 uppercase text-xs tracking-widest">
                Registrar Materia
            </button>
        </form>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-azul-marino text-white">
                <th class="p-5 text-xs font-bold uppercase tracking-widest">ID</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Clave</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest">Nombre de la Asignatura</th>
                <th class="p-5 text-xs font-bold uppercase tracking-widest text-right">Fecha Registro</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($materias as $materia)
                <tr class="hover:bg-f5f6f3 transition-colors duration-200">
                    <td class="p-5 text-xs text-gris-escolar font-bold">
                        #{{ $materia->id }}
                    </td>
                    <td class="p-5">
                        <span class="inline-block px-3 py-1 bg-cafe-acento/10 text-cafe-acento rounded-lg font-black text-xs border border-cafe-acento/20 font-mono uppercase">
                            {{ $materia->clave_materia }}
                        </span>
                    </td>
                    <td class="p-5">
                        <span class="font-bold text-azul-marino text-sm">{{ $materia->nombre }}</span>
                    </td>
                    <td class="p-5 text-right">
                        <span class="text-[10px] font-bold text-azul-claro uppercase">
                            {{ $materia->created_at->diffForHumans() }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-10 text-center text-gris-escolar italic bg-gray-50">
                        No hay materias registradas en el catálogo.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($materias instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-6">
        {{ $materias->links() }}
    </div>
@endif
@endsection