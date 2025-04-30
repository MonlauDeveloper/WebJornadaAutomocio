@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-4xl font-bold text-blue-600 text-center">Agregar Nueva Presentación</h2>
    
    <!-- Formulario para crear una nueva presentación -->
    <form action="{{ route('presentations.store') }}" method="POST" class="space-y-6 mt-6">
        @csrf
        
        <div>
            <label for="presentationName" class="block text-sm font-medium text-gray-600">Nombre de la Presentación</label>
            <input type="text" id="presentationName" name="presentationName" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

        <div>
            <label for="topic" class="block text-sm font-medium text-gray-600">Tema</label>
            <input type="text" id="topic" name="topic" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required maxlength="300">
        </div>

        <div>
            <label for="presentationDate" class="block text-sm font-medium text-gray-600">Hora de Presentación</label>
            <input type="time" id="presentationDate" name="presentationDate" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

        <!-- Ubicación -->        
        <div class="mb-4">
            <label for="idUbication" class="block text-gray-700 font-semibold mb-2">Ubicación</label>
            <select name="idUbication" id="idUbication" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                @foreach($ubications as $ubication)
                    <option value="{{ $ubication->idUbication }}">{{ $ubication->ubicationName }}</option>
                @endforeach
            </select>
            @error('idUbication')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
            Agregar Presentación
        </button>
    </form>
</div>
@endsection
