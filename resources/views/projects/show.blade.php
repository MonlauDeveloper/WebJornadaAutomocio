@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ public_path('build/assets/app-Cvpg7NpT.css') }}">
<div class="container mx-auto p-6">
    <!-- Información del Proyecto -->
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <div class="flex items-center justify-center  gap-4">
            @if ($project->idSpecialization == 5)
                <img src="{{ asset('storage/photos/' . $logo) }}" alt="Logo del equipo" class="w-12 h-12 rounded-full">
            @endif
            <h1 class="text-5xl font-bold text-blue-600">{{ $project->title }}</h1>
        </div>

        <p class="text-gray-600 mt-4 text-lg">
            <strong>Categoría: </strong>{{ $project->specialization ? $project->specialization->specialization : '' }}
        </p>
        <p class="text-gray-600 mt-4 text-lg">
            <strong>Ubicación: </strong>{{ $project->ubication ? $project->ubication->ubicationName : '' }},
            <strong> Tribunal: </strong>{{ $project->numTribunal }}
        </p>
        <img class="w-3/4 object-cover rounded-lg mt-4 mx-auto" src="{{ asset('storage/photos/' . $project->photoName) }}" alt="{{ $project->title }}">

        <p class="text-gray-600 mt-4 text-lg">{{ $project->abstract }}</p>

        <div class="w-3/4 mt-6 mx-auto">
            <p class="font-semibold text-2xl text-blue-500">Vídeo:</p>
            @if ($project->videoURL)
                <!-- Mostrar el video de YouTube -->
                <iframe width="80%" height="480" style="margin-left: 10%" src="{{ $project->videoURL }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @else
                <span class="text-gray-500">No disponible</span>
            @endif
        </div>

        <div class="mt-6">
            <p class="font-semibold text-2xl text-blue-500">PDF:</p>
            @if ($project->pdfURL)
                <a href="{{ asset('storage/pdfs/' . $project->pdfURL) }}"  class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Ver PDF</a>
            @else
                <span class="text-gray-500">No disponible</span>
            @endif
        </div>

        @if(auth()->user()->idRole === 1 || auth()->user()->idRole === 4)
        <div class="mt-6">
            <p class="font-semibold text-2xl text-blue-500">Moodle URL:</p>
            @if ($project->moodleURL)
                <a href="{{ $project->moodleURL }}" class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Acceder a Moodle</a>
            @else
                <span class="text-gray-500">No disponible</span>
            @endif
        </div>
        @endif
    </div>

    <!-- Estudiantes Involucrados -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600">Estudiantes Involucrados</h2>

        @if($project->students->isNotEmpty())
            <ul class="mt-4 space-y-4">
                @foreach ($project->students as $student)
                    <li class="flex items-center">
                        <a href="{{ route('students.show', $student->idStudent) }}" class="flex items-center hover:underline">
                            <img class="w-12 h-12 object-cover rounded-full mx-auto mr-4" 
                                src="{{ $student->photoName }}" 
                                alt="{{ $student->name }}"
                                onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                            <div class="flex-1">
                                <p class="font-semibold text-lg text-gray-800">{{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}</p>
                        </a>
                            @if ($student->isTeamLeader)
                                <span class="text-sm text-green-600 font-medium">(Líder del Proyecto)</span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No hay estudiantes asignados a este proyecto.</p>
        @endif
    </div>

    <div class="mt-6 text-center">
        <a href="javascript:history.back()" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">Volver al listado</a>
        @if(auth()->user()->idRole === 1)
            <a href="{{ route('projects.edit', $project->idProject) }}" class="text-white bg-yellow-800 hover:bg-yellow-900 py-3 px-6 rounded-lg">Editar</a>
        @endif
    </div>
</div>
@endsection
