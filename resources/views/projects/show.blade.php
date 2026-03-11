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
            <img class="w-3xl h-auto object-cover rounded-lg mt-4 mx-auto"
                src="{{ asset('storage/photos/' . $project->photoName) }}" alt="{{ $project->title }}">

            <p class="text-gray-600 mt-4 text-lg max-w-3xl mx-auto leading-relaxed break-words">{{ $project->abstract }}</p>

            <div class="w-full max-w-3xl mt-8 mx-auto">
                <p class="font-bold text-xl text-gray-800 border-b border-gray-100 pb-2">Vídeo de presentación</p>

                @if ($project->videoURL)
                    <div class="aspect-video w-full rounded-xl overflow-hidden bg-black mt-4 shadow-sm">
                        <iframe class="w-full h-full" src="{{ $project->embed_video_url }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-6 mt-4 text-center border border-dashed border-gray-200">
                        <p class="text-gray-500 italic">Vídeo no disponible</p>
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <p class="font-semibold text-2xl text-blue-500">PDF:</p>
                <div class="mt-6 text-center">

                    @if ($project->idProject)
                        <a href="{{ route('project.pdf', $project->idProject) }}"
                            class="text-white bg-green-600 hover:bg-green-700 py-3 px-6 rounded-lg">
                            Descargar Ficha Técnica
                        </a>
                    @else
                        <span class="text-gray-500">No disponible</span>
                    @endif
                </div>
            </div>

            @if(auth()->user()->idRole === 1 || auth()->user()->idRole === 4)
                <div class="mt-6">
                    <p class="font-semibold text-2xl text-blue-500">Moodle URL:</p>
                    @if ($project->moodleURL)
                        <a href="{{ $project->moodleURL }}"
                            class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Acceder a
                            Moodle</a>
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
                                <div
                                    class="w-12 h-12 overflow-hidden rounded-full mr-4 bg-gray-100 border border-gray-200 shadow-sm">
                                    <img class="w-full h-full object-cover object-top"
                                        src="{{ asset('storage/' . $student->photoName) }}" alt="{{ $student->name }}"
                                        onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-lg text-gray-800">
                                        {{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}
                                    </p>
                                </div>
                            </a>
                            @if ($student->isTeamLeader)
                                <span class="text-sm text-green-600 font-medium ml-2">(Líder del Proyecto)</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No hay estudiantes asignados a este proyecto.</p>
            @endif
        </div>

        <div class="mt-6 text-center">
            <a href="javascript:history.back()" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">Volver
                al listado</a>
            @if(auth()->user()->idRole === 1)
                <a href="{{ route('projects.edit', $project->idProject) }}"
                    class="text-white bg-yellow-800 hover:bg-yellow-900 py-3 px-6 rounded-lg">Editar</a>
            @endif
        </div>
    </div>
@endsection