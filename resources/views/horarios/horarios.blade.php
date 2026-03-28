@extends('layouts.app')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-black text-azul-marino tracking-tight">Mi Horario de Clases</h2>
    <p class="text-azul-claro text-sm italic">Carga académica vigente para el ciclo escolar</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($inscripciones as $inscripcion)
        <div class="group bg-white border-l-8 border-cafe-acento shadow-lg rounded-xl overflow-hidden hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="space-y-1">
                        <h3 class="text-xl font-bold text-azul-marino leading-tight group-hover:text-cafe-acento transition-colors">
                            {{ $inscripcion->grupo?->horario?->materia?->nombre ?? 'Materia no asignada' }}
                        </h3>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-black uppercase tracking-tighter text-gris-escolar bg-gray-100 px-2 py-0.5 rounded border border-gray-200">
                                {{ $inscripcion->grupo?->horario?->materia?->clave_materia ?? 'S/C' }}
                            </span>
                        </div>
                    </div>
                    <span class="bg-azul-marino text-cafe-acento text-[10px] font-black px-3 py-1 rounded-full shadow-sm">
                        {{ $inscripcion->grupo?->clave_grupo ?? $inscripcion->grupo?->nombre }}
                    </span>
                </div>

                <hr class="border-gray-100 my-4">

                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-lg bg-f5f6f3 flex items-center justify-center mr-3">
                            <span class="text-azul-marino text-xs">📅</span>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold text-azul-claro tracking-widest">Día y Hora</p>
                            <p class="text-sm font-bold text-azul-marino">
                                {{ $inscripcion->grupo?->horario?->dias ?? 'Día pendiente' }}
                                <span class="text-cafe-acento ml-1">{{ $inscripcion->grupo?->horario?->hora_inicio }} - {{ $inscripcion->grupo?->horario?->hora_fin }}</span>
                            </p>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center">
                <div class="flex items-center gap-1.5">
                    <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                    <span class="text-[10px] text-gris-escolar font-bold uppercase tracking-tight">Estatus: Inscrito</span>
                </div>
                <span class="text-[9px] text-azul-claro font-medium uppercase italic">Ref: {{ $inscripcion->created_at->format('d/m/Y') }}</span>
            </div>
        </div>
    @empty
        <div class="col-span-full py-20 px-10 bg-white border-2 border-dashed border-gray-200 rounded-3xl text-center">
            <div class="text-5xl mb-4">📚</div>
            <h3 class="text-xl font-bold text-azul-marino">Tu horario está vacío</h3>
            <p class="text-gris-escolar mt-2 mb-6">Parece que aún no te has inscrito a ningún grupo para este ciclo.</p>
        </div>
    @endforelse
</div>
@endsection