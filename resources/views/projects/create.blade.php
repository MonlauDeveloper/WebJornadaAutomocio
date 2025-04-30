@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Formulario para Crear Proyecto -->
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Crear Proyecto</h1>

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            @csrf
            <!-- Título del Proyecto -->
            <div>
                <label for="title" class="block text-lg font-semibold text-blue-500">Título del Proyecto</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

             <!-- Categoria del Proyecto -->
             <div>
                <label for="categoria" class="block text-lg font-semibold text-blue-500">Categoría del Proyecto</label>
                <input type="text" name="categoria" id="categoria" value="{{ old('categoria') }}" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('categoria')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto del Proyecto -->
            <div>
                <label for="photoName" class="block text-lg font-semibold text-blue-500">Foto del Proyecto</label>
                <input type="file" name="photo" id="photo" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>

                @error('photoName')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Resumen del Proyecto -->
            <div>
                <label for="abstract" class="block text-lg font-semibold text-blue-500">Resumen del Proyecto</label>
                <textarea name="abstract" id="abstract" rows="4" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('abstract') }}</textarea>
                @error('abstract')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Video del Proyecto -->
            <div>
                <label for="videoFile" class="block text-lg font-semibold text-blue-500">Archivo de Video</label>
                <input type="file" name="videoFile" id="videoFile" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="video/*">

                @error('videoFile')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL del PDF -->
            <div>
                <label for="pdfURL" class="block text-lg font-semibold text-blue-500">URL del PDF</label>
                <input type="url" name="pdfURL" id="pdfURL" value="{{ old('pdfURL') }}" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('pdfURL')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL de Moodle -->
            <div>
                <label for="moodleURL" class="block text-lg font-semibold text-blue-500">URL de Moodle (Opcional)</label>
                <input type="url" name="moodleURL" id="moodleURL" value="{{ old('moodleURL') }}" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('moodleURL')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botón de Enviar -->
            <div class="text-center">
                <button type="submit" class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">Crear Proyecto</button>
            </div>
        </form>
    </div>
</div>
@endsection
