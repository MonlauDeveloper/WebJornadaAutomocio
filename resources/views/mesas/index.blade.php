@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Gestión de Mesas</h1>

    <div class="max-w-4xl mx-auto mb-6">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center">
                <div>
                    <p class="font-bold">¡Operación exitosa!</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                <p class="font-bold">Error</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="grid gap-8 max-w-6xl mx-auto">
        
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-100 sticky top-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Asignar Nueva Mesa</h2>
                
                <form method="POST" action="{{ route('company-tables.store') }}" class="space-y-4">
                    @csrf
                    
                    <div>
    <label for="idCompany" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Empresa</label>
    
    <div class="relative">
        <select name="idCompany" id="idCompany" required
                class="w-full border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none bg-white">
            <option value="" disabled selected>-- Elige una empresa --</option>
            
            @foreach($companies as $company)
                <option value="{{ $company->idCompany }}">
                    {{ $company->companyName }} (ID: {{ $company->idCompany }})
                </option>
            @endforeach
            
        </select>
        
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
            </svg>
        </div>
    </div>
</div>

                    <div>
                        <label for="tableName" class="block text-gray-700 text-sm font-bold mb-2">Nombre Mesa</label>
                        <input type="text" name="tableName" id="tableName" required placeholder="Ej: Mesa 1"
                               class="w-full border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white hover:bg-blue-700 font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                        Guardar
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Mesas Asignadas Actualmente</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID Mesa</th>
                                <th class="py-3 px-6 text-left">Nombre Mesa</th>
                                <th class="py-3 px-6 text-left">Empresa Asignada</th>
                                <th class="py-3 px-6 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse($tables as $table)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <span class="font-medium">{{ $table->idTable }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs font-bold">
                                            {{ $table->tableName }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <span class="font-medium">{{ $table->companyName }}</span>
                                            <span class="text-xs text-gray-400 ml-2">(ID: {{ $table->idCompany }})</span>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-4">
                                            <a href="{{ route('company-tables.edit', $table->idTable) }}" class="transform hover:text-blue-500 hover:scale-110 transition-transform" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('company-tables.destroy', $table->idTable) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres liberar esta mesa?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="transform hover:text-red-500 hover:scale-110 transition-transform" title="Borrar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
        
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">
                                        No hay mesas asignadas todavía. ¡Usa el formulario para crear la primera!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection