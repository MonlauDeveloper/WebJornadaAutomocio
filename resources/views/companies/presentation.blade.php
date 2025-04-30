@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h2 class="text-4xl font-bold text-blue-600 text-center">Gestionar Presentación</h2>
        
        <!-- Mensajes de éxito o error -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulario de Presentación -->
        <form action="{{ route('companies.updatePresentation') }}" method="POST" class="space-y-6 mt-4">
            @csrf
            @method('POST')

            @if(isset($presentation))
                <input type="hidden" name="idPresentation" value="{{ $presentation->idPresentation }}">
            @endif

            <div>
                <label for="presentationName" class="block text-sm font-medium text-gray-600">Nombre de la Presentación</label>
                <input type="text" id="presentationName" name="presentationName" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('presentationName', $presentation->presentationName ?? '') }}" required>
            </div>

            <div>
                <label for="topic" class="block text-sm font-medium text-gray-600">Tema de la Presentación</label>
                <input type="text" id="topic" name="topic" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('topic', $presentation->topic ?? '') }}" required>
            </div>

            <div>
                <label for="presentationDate" class="block text-sm font-medium text-gray-600">Fecha de la Presentación</label>
                <input type="date" id="presentationDate" name="presentationDate" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('presentationDate', $presentation->presentationDate ?? '') }}" required>
            </div>

            <div>
                <label for="idUbication" class="block text-sm font-medium text-gray-600">Ubicación</label>
                <input type="text" id="idUbication" name="idUbication" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    value="{{ old('idUbication', $presentation->idUbication ?? '') }}" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                Guardar Cambios
            </button>
        </form>
    </div>
    
</div>
@endsection
