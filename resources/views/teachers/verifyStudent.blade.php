@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-semibold text-center text-blue-600 mb-8 flex items-center justify-center">
        Verificación del Estudiante: {{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}
        <i class="ml-2 fas fa-{{ $verificationStatus }} text-5xl {{ $verificationStatus == 'exclamation-circle' ? 'text-red-500' : ($verificationStatus == 'check-circle' ? 'text-yellow-500' : 'text-green-500') }}"></i>
    </h1>


    <!-- Sección de Datos del Estudiante -->
    <div class="bg-gray-100 p-6 rounded-lg mt-8 shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600 mb-4">Datos del Estudiante</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label class="font-semibold text-blue-500">Nombre:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->name ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->name ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}</p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Foto:</label>
                <div class="flex">
                    <span class="mr-1 {{ $student->photoName ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->photoName ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    @if ($student->photoName)
                        <img class="w-32 h-32 object-cover rounded-full" src="{{ $student->photoName }}" alt="{{ $student->name }}" onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                    @else
                        <span class="text-gray-500">No proporcionado</span>
                    @endif
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Introducción:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->introduction ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->introduction ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $student->introduction ?? 'No proporcionada' }}</p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Especialización:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->specialization->specialization ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->specialization->specialization ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $student->specialization->specialization ?? 'No proporcionada' }}</p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Curso:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->curso ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->curso ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $student->curso ?? 'No proporcionado' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Datos del Proyecto -->
    <div class="bg-gray-100 p-6 rounded-lg mt-8 shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600 mb-4">Datos del Proyecto</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label class="font-semibold text-blue-500">Título del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->title ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->title ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $project->title ?? 'No proporcionado' }}</p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Especialización del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->specialization->specialization ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->specialization->specialization ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $project->specialization->specialization ?? 'No proporcionada' }}</p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Curso del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->curso ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->curso ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $project->curso ?? 'No proporcionado' }}</p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Resumen del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->abstract ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->abstract ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $project->abstract ?? 'No proporcionado' }}</p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Enlace a Moodle:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->moodleURL ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->moodleURL ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    @if ($project->moodleURL)
                        <a href="{{ $project->moodleURL }}" class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Acceder a Moodle</a>
                    @else
                        <span class="text-gray-500">No proporcionado</span>
                    @endif
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">PDF del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->pdfURL ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->pdfURL ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    @if ($project->pdfURL)
                        <a href="{{ asset('storage/pdfs/' . $project->pdfURL) }}"  class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Ver PDF</a>
                    @else
                        <span class="text-gray-500">No proporcionado</span>
                    @endif     
                   </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Foto del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->photoName ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->photoName ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <img class="h-32 object-cover" src="{{ asset('storage/photos/' . $project->photoName) }}" alt="{{ $project->photoName }}">
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Vídeo del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->videoURL ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->videoURL ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    @if ($project->videoURL)
                        <!-- Mostrar el video en lugar de un enlace -->
                        <iframe class="h-32" src="{{ $project->videoURL }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <span class="text-gray-500">No proporcionado</span>
                    @endif
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Ubicación del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $project->ubication && $project->ubication->ubicationName ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $project->ubication && $project->ubication->ubicationName ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <p>{{ $project->ubication && $project->ubication->ubicationName ? $project->ubication->ubicationName : 'No proporcionada' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Datos del Currículum -->
    <div class="bg-gray-100 p-6 rounded-lg mt-8 shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600 mb-4">Datos del Currículum</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label class="font-semibold text-blue-500">Lenguajes:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->languages->isNotEmpty() ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->languages->isNotEmpty() ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <ul>
                        @foreach ($student->languages as $language)
                        <li>{{ $language->language }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Educación:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->educations->isNotEmpty() ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->educations->isNotEmpty() ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <ul>
                        @foreach ($student->educations as $education)
                        <li>{{ $education->education }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Experiencia Laboral:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->workExperiences->isNotEmpty() ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->workExperiences->isNotEmpty() ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <ul>
                        @foreach ($student->workExperiences as $workExperience)
                        <li>{{ $workExperience->work_experience }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Contacto:</label>
                <div class="flex items-center">
                    <span class="mr-1 {{ $student->contacts->isNotEmpty() ? 'text-green-500' : 'text-red-500' }}">
                        <i class="fas fa-{{ $student->contacts->isNotEmpty() ? 'check-circle' : 'exclamation-circle' }}"></i>
                    </span>
                    <ul>
                        @foreach ($student->contacts as $contact)
                        <li>{{ $contact->contact }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para verificar alumno -->
    <div class="mt-6 text-center">
        <form action="{{ route('professor.verify', $student->idStudent) }}" method="POST">
            @csrf
            @if ($student->verification_status == 'verificado') 
                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-lg">
                    Eliminar Verificado
                </button>
            @else
                <button type="submit" class="text-white bg-green-600 hover:bg-green-700 py-2 px-4 rounded-lg">
                    Verificar Alumno
                </button>
            @endif
        </form>
    </div>
    <div class="mt-6 mb-6 text-center">
        <a href="javascript:history.back()" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">
            Volver Atrás
        </a>
    </div>
</div>
@endsection
