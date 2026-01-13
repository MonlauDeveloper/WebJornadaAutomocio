@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-100">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Editar Asignación de Mesa</h2>
            <p class="text-gray-500 mt-2">Modificando mesa ID: {{ $table->idTable }}</p>
        </div>

        <form method="POST" action="{{ route('company-tables.update', $table->idTable) }}" class="space-y-6">
            @csrf
            @method('PUT') 
            
            <div class="grid grid-cols-1 gap-6">
                
                <div>
                    <label for="idCompany" class="block text-gray-700 text-sm font-bold mb-2">Empresa Asignada</label>
                    <div class="relative">
                        <select name="idCompany" id="idCompany" required
                                class="w-full border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none bg-white">
                            
                            <option value="" disabled>-- Selecciona una empresa --</option>

                            @foreach($companies as $company)
                                <option value="{{ $company->idCompany }}" 
                                    {{ $table->idCompany == $company->idCompany ? 'selected' : '' }}>
                                    {{ $company->companyName }} (ID: {{ $company->idCompany }})
                                </option>
                            @endforeach

                        </select>
                        
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="tableName" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Mesa</label>
                    <input type="text" 
                           name="tableName" 
                           value="{{ $table->tableName }}"
                           required 
                           class="w-full border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex items-center justify-between mt-8">
                <a href="{{ route('mesas.index') }}" class="text-gray-500 hover:text-gray-700 font-semibold">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 font-bold py-2 px-8 rounded-lg shadow-md transition-all">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

