@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Formulario para Subir CSV -->
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Subir CSV</h1>

        <form action="{{ route('projects.subircsv') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            @csrf
            <!-- Archivo CSV -->
            <div>
                <label for="csvFile" class="block text-lg font-semibold text-blue-500">Archivo CSV</label>
                <input type="file" name="csvFile" id="csvFile" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".csv" required>
                
                @error('csvFile')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botón de Enviar -->
            <div class="text-center">
                <button type="submit" class="mt-6 bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition">Subir CSV</button>
            </div>
        </form>
    </div>
</div>
@endsection
