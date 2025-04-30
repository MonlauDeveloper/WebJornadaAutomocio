@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Mi Proyecto</h1>

        <!-- Mostrar el ícono de exclamación roja si el proyecto está incompleto -->
        @if($projectIncomplete)
            <div class="text-center text-red-500 mt-4">
                <span class="text-5xl">❗</span>
                <p class="mt-2">Tu proyecto está incompleto. Por favor, completa todos los campos.</p>
            </div>
        @endif

        <form action="{{ route('students.updateProject') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            @csrf

            <!-- Título del Proyecto (bloqueado) -->
            <div>
                <label for="title" class="block text-lg font-semibold text-blue-500">Título del Proyecto</label>
                <input type="text" id="title" name="title" value="{{ $project->title }}" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <!-- Especialización (bloqueado) -->
            <div>
                <label for="idSpecialization" class="block text-lg font-semibold text-blue-500">Especialización</label>
                <input type="text" id="idSpecialization" name="idSpecialization" value="{{ $project->specialization ? $project->specialization->specialization : '' }}" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <!-- Foto del Proyecto -->
            <div>
                <label for="photoName" class="block text-lg font-semibold text-blue-500">Foto del Proyecto</label>
                <input type="file" id="photoName" name="photoName" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($project->photoName)
                    <p class="mt-2 text-sm text-gray-600">Archivo actual: {{ $project->photoName }}</p>
                @endif
            </div>

            <!-- Video del Proyecto -->
            <div>
                <label for="videoURL" class="block text-lg font-semibold text-blue-500">Enlace de Video de YouTube</label>
                <input type="url" id="videoURL" name="videoURL" value="{{ $project->videoURL }}" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingresa el enlace de YouTube" onblur="validateVideoURL()">
                @if ($project->videoURL)
                    <p class="mt-2 text-sm text-gray-600">Enlace actual: <a href="{{ $project->videoURL }}" target="_blank" class="text-blue-500">{{ $project->videoURL }}</a></p>
                @endif
                <p id="url-error" class="text-red-500 text-sm hidden">El enlace debe comenzar con "https://www.youtube.com/embed/".</p>
            </div>

            <script>
                // Función para validar el enlace de YouTube
                function validateVideoURL() {
                    var videoURL = document.getElementById("videoURL").value;
                    var errorMessage = document.getElementById("url-error");

                    // Verifica si el enlace empieza con "https://www.youtube.com/embed/"
                    if (!videoURL.startsWith("https://www.youtube.com/embed/")) {
                        errorMessage.classList.remove("hidden");  // Muestra el mensaje de error
                    } else {
                        errorMessage.classList.add("hidden");  // Oculta el mensaje de error
                    }
                }
            </script>

            <!-- Documento PDF -->
            <div>
                <label for="pdfURL" class="block text-lg font-semibold text-blue-500">Documento PDF del Proyecto</label>
                <input type="file" id="pdfURL" name="pdfURL" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($project->pdfURL)
                    <p class="mt-2 text-sm text-gray-600">Archivo actual: {{ $project->pdfURL }}</p>
                @endif
            </div>

            <!-- Descripción del Proyecto -->
            <div>
                <label for="abstract" class="block text-lg font-semibold text-blue-500">Descripción del Proyecto</label>
                <textarea id="abstract" name="abstract" rows="5" maxlength="300" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $project->abstract }}</textarea>
            </div>

            <!-- Botón de Actualización -->
            <div class="text-center">
                <button type="submit" class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">Actualizar Proyecto</button>
            </div>
        </form>
    </div>
</div>
@endsection
