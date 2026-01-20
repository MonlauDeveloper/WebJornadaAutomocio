@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 sm:p-8 bg-gray-50 min-h-screen">
    <div class="flex flex-col justify-center items-center mb-12 gap-4 text-center">
        <div>
            <h1 class="text-4xl font-extrabold text-blue-600">Gestión de Mesas</h1>
            <p class="text-gray-500">Administra la distribución de empresas y el flujo de entrevistas.</p>
        </div>
        <div class="flex gap-3">
            <div class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md">
                <span class="text-2xl font-bold">{{ $tables->count() }}</span> Mesas Activas
            </div>
            <div class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md">
                <span class="text-2xl font-bold">{{ $totalInterviews ?? 0 }}</span> Entrevistas Totales
            </div>
        </div>
    </div>
    
    {{-- Mensaje de confirmación --}}
    <div class="max-w-3xl mx-auto mb-12">
        @if (session('success'))
            <div class="bg-white border-l-4 border-green-500 text-green-700 p-5 rounded-xl shadow-md flex items-center justify-center">
                <svg class="h-6 w-6 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                <p class="font-bold text-lg ml-2">{{ session('success') }}</p>
            </div>
        @endif
    </div>

    {{-- Formulario de Asignación --}}
    <div class="bg-white p-8 rounded-3xl shadow-md border border-gray-300 mb-16 max-w-6xl mx-auto">
        <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
            <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Asignar Nueva Empresa a Mesa
        </h2>
        <form method="POST" action="{{ route('company-tables.store') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
            @csrf
            <div>
                <label class="block text-gray-600 text-xs font-bold uppercase mb-1 ml-1">Empresa</label>
                <select name="idCompany" required class="w-full border-gray-300 rounded-xl shadow-sm py-2.5 focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Selecciona empresa...</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->idCompany }}">{{ $company->companyName }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-600 text-xs font-bold uppercase mb-1 ml-1">Identificador de Mesa</label>
                <input type="text" name="tableName" required placeholder="Ej: A-12" class="w-full border-gray-300 rounded-xl shadow-sm py-2.5 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition duration-200 shadow-lg">
                Confirmar Asignación
            </button>
        </form>
    </div>

    {{-- Grid de Mesas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 max-w-7xl mx-auto pb-12 mt-6">
        @forelse($tables as $table)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-200 hover:shadow-xl transition-all duration-300 overflow-hidden group">
                <div class="bg-gray-50 p-4 border-b border-gray-200 flex justify-between items-center group-hover:bg-blue-50 transition-colors">
                    <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Mesa</span>
                    <span class="bg-white border border-blue-200 text-blue-700 px-3 py-1 rounded-full text-sm font-bold shadow-sm">
                        {{ $table->tableName }}
                    </span>
                </div>
                
                <div class="p-6">
                    <h3 class="text-gray-900 font-bold text-xl mb-1 leading-tight">{{ $table->companyName }}</h3>
                    <p class="text-gray-400 text-sm mb-4 font-medium">ID Empresa: {{ $table->idCompany }}</p>
                    
                    <div class="flex items-center text-gray-400 text-xs mb-6">
                        <svg class="h-4 w-4 mr-1 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Ubicación confirmada
                    </div>

                    {{-- Sección de Entrevistas--}}
                    <div class="p-1" x-data="{ mostrarHoras: false }">
                        <div class="flex items-center justify-between text-gray-400 text-xs mb-3 uppercase">
                            <span class="text-gray-600 text-xs font-bold tracking-wider">Entrevistas</span>
                            <span class="text-black text-sm px-2 py-1 rounded-full font-bold">
                                {{ count($table->interviews ?? []) }} / 9
                            </span>
                        </div>

                        <div class="flex justify-end mb-3">
                            <button @click="mostrarHoras = !mostrarHoras" type="button" 
                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-2 py-1 rounded-full font-bold transition-colors uppercase tracking-tight">
                                <span x-text="mostrarHoras ? 'CERRAR' : 'VER DETALLE'"></span>
                            </button>
                        </div>

                        {{--Desplegable de las horas --}}
                        <div x-show="mostrarHoras" x-cloak x-transition class="mb-4 space-y-2 max-h-52 overflow-y-auto pr-1 bg-indigo-50/50 p-2 rounded-xl border border-indigo-100">
                            @php
                                $citas = collect($table->interviews ?? [])->keyBy(function($i) {
                                    return \Carbon\Carbon::parse($i->hour)->format('H:i');
                                });
                                $inicio = \Carbon\Carbon::createFromTime(10, 0);
                                $fin = \Carbon\Carbon::createFromTime(14, 0);
                            @endphp

                            @while($inicio <= $fin)
                                @php 
                                    $horaActual = $inicio->format('H:i');
                                    $cita = $citas->get($horaActual);
                                @endphp
                                <div class="flex items-center justify-between p-2 rounded-lg text-[11px] {{ $cita ? 'bg-white border border-indigo-200 shadow-sm' : 'bg-gray-50/50 border border-transparent text-gray-400' }}">
                                    <span class="font-bold {{ $cita ? 'text-indigo-900' : '' }}">
                                        {{ $horaActual }}
                                    </span>
                                    @if($cita)
                                        <div class="text-right">
                                            <span class="text-indigo-700 font-semibold block leading-none">{{ $cita->studentName ?? 'Ocupado' }}</span>
                                            <span class="text-[8px] text-green-500 font-bold uppercase">Confirmado</span>
                                        </div>
                                    @else
                                        <span class="uppercase text-[8px] tracking-tighter">Disponible</span>
                                    @endif
                                </div>
                                @php $inicio->addMinutes(30); @endphp
                            @endwhile
                        </div>

                        <div class="mt-1 h-1.5 w-full bg-indigo-100 rounded-full overflow-hidden">
                            @php 
                                $totalSlots = 7; 
                                $ocupados = count($table->interviews ?? []);
                                $porcentaje = ($ocupados / $totalSlots) * 100;
                            @endphp
                            <div class="h-full bg-indigo-600 rounded-full shadow-[0_0_8px_rgba(79,70,229,0.3)] transition-all duration-500" 
                                style="width: {{ $porcentaje }}%"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-5 mt-4 border-t border-gray-100">
                        <a href="{{ route('company-tables.edit', $table->idTable) }}" class="text-blue-500 hover:text-blue-700 flex items-center text-sm font-semibold transition-colors">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Editar
                        </a>
                        
                        <form action="{{ route('company-tables.destroy', $table->idTable) }}" method="POST" onsubmit="return confirm('¿Liberar esta mesa?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-300 hover:text-red-600 p-2 rounded-xl hover:bg-red-50 transition-all duration-200">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white rounded-3xl border-2 border-dashed border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <p class="text-gray-500 text-lg">No hay mesas configuradas actualmente.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection