@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <!-- Editar Ponente -->
        <h2 class="text-4xl font-bold text-blue-600 text-center">Editar Ponente</h2>

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

        <form action="{{ route('companies.updateSpeaker') }}" method="POST" class="space-y-6 mt-4">
            @csrf
            <input type="hidden" name="idSpeaker" value="{{ $speaker->idSpeaker }}">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-600">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $speaker->name) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label for="surname1" class="block text-sm font-medium text-gray-600">Primer Apellido</label>
                <input type="text" id="surname1" name="surname1" value="{{ old('surname1', $speaker->surname1) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label for="surname2" class="block text-sm font-medium text-gray-600">Segundo Apellido</label>
                <input type="text" id="surname2" name="surname2" value="{{ old('surname2', $speaker->surname2) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-600">Descripción</label>
                <textarea id="description" name="description" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                    rows="3">{{ old('description', $speaker->description) }}</textarea>
            </div>

            <div>
                <label for="birthDate" class="block text-sm font-medium text-gray-600">Fecha de Nacimiento</label>
                <input type="date" id="birthDate" name="birthDate" value="{{ old('birthDate', isset($speaker->birthDate) ? \Carbon\Carbon::parse($speaker->birthDate)->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                Actualizar Ponente
            </button>
        </form>
    </div>
</div>
@endsection
