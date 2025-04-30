@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <img class="w-32 h-32 object-cover rounded-full mx-auto" 
                 src="{{ $student->photoName }}" 
                 alt="{{ $student->name }}"
                 onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">

        <h1 class="text-4xl font-bold text-blue-600 mt-4">{{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}</h1>

        <p class="text-gray-600 mt-2">
            <strong>Especialización:</strong> {{ $student->specialization->specialization ?? 'No especificada' }}
        </p>

        <p class="text-gray-600 mt-2">
            <strong>Equipo:</strong> {{ $student->team->teamName ?? 'Sin equipo asignado' }}
        </p>
    </div>

    <!-- Currículum -->
    <div class="mt-8">

        <!-- Introducción (ocupa toda la línea) -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h3 class="text-xl font-semibold text-blue-600 mb-4">Sobre mí</h3>
            <p class="text-gray-700">{{ $student->introduction ?? 'No especificada' }}</p>
        </div>

        <!-- Contacto y Experiencia en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Contacto -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Contacto</h3>
                <div>
                    @forelse($student->contacts as $contact)
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700">{{ $contact->contact ?? 'No especificada' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-700">No especificado</p>
                    @endforelse
                </div>
            </div>

            <!-- Experiencia Laboral -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Experiencia Laboral</h3>
                <div>
                    @forelse($student->workExperiences as $experience)
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700">{{ $experience->work_experience ?? 'No especificada' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-700">No especificada</p>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Educacion y Idiomas en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

            <!-- Educación -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Formación</h3>
                <div>
                    @forelse($student->educations as $education)
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700">{{ $education->education ?? 'No especificada' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-700">No especificada</p>
                    @endforelse
                </div>
            </div>

            <!-- Idiomas -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Idiomas</h3>
                <div>
                    @forelse($student->languages as $language)
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700">{{ $language->language ?? 'No especificada' }}</p>
                        </div>
                    @empty
                        <p class="text-gray-700">No especificado</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('students.descargar', $student->idStudent) }}" class="mr-2 ml-2 text-white bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-lg">
            Descargar Currículum
        </a>
        <a href="{{ route('projects.show', $student->idProject) }}" class="mr-2 ml-2 text-white bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-lg">
            Ver Proyecto
        </a>
        @if(auth()->user()->idRole === 1)
        <a href="{{ route('students.edit', $student->idStudent) }}" class="mr-2 ml-2 text-white bg-yellow-800 hover:bg-yellow-900 py-3 px-6 rounded-lg">
            Editar
        </a>
        @endif
        <a href="javascript:history.back()" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">
            Volver Atrás
        </a>
    </div>


</div>
@endsection
