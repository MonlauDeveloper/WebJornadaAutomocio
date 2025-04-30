@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-4xl font-bold text-blue-600 text-center">Editar Presentación</h2>
    
    <!-- Formulario de edición de la presentación -->
    <form action="{{ route('presentations.update', $presentation->idPresentation) }}" method="POST" class="space-y-6 mt-6">
        @csrf
        @method('PUT')
        
        <div>
            <label for="presentationName" class="block text-sm font-medium text-gray-600">Nombre de la Presentación</label>
            <input type="text" id="presentationName" name="presentationName" value="{{ old('presentationName', $presentation->presentationName) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

        <div>
            <label for="topic" class="block text-sm font-medium text-gray-600">Tema</label>
            <input type="text" id="topic" name="topic" value="{{ old('topic', $presentation->topic) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required maxlength="300">
        </div>

        <div>
            <label for="presentationDate" class="block text-sm font-medium text-gray-600">Hora de Presentación</label>
            <input type="time" id="presentationDate" name="presentationDate" 
                value="{{ old('presentationDate', $presentation->presentationDate->format('H:i')) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

         <!-- Ubicación -->        
         <div class="mb-4">
            <label for="idUbication" class="block text-gray-700 font-semibold mb-2">Ubicación</label>
            <select name="idUbication" id="idUbication" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                @foreach($ubications as $ubication)
                    <option value="{{ $ubication->idUbication }}" 
                        {{ old('idUbication', $presentation->idUbication) == $ubication->idUbication ? 'selected' : '' }}>
                        {{ $ubication->ubicationName }} <!-- Aquí el cambio -->
                    </option>
                @endforeach
            </select>
            @error('idUbication')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
            Actualizar Presentación
        </button>
    </form>
    <div class="mt-6">
        <!-- Formulario para eliminar presentación -->
        <form action="{{ route('presentations.destroy', $presentation->idPresentation) }}" method="POST" class="w-full">
            @csrf
            @method('DELETE')
            
            <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition" onclick="return confirm('¿Seguro que quieres eliminar esta ponencia?');">
                Eliminar Presentación
            </button>
        </form>
    </div>
</div>
@endsection
