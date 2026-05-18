@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4 sm:p-6">
        <!-- Tarjeta Principal -->
        <div class="bg-white p-4 sm:p-8 rounded-2xl shadow-xl text-center border border-gray-100">
            
            <h1 class="text-3xl sm:text-5xl font-extrabold text-slate-800 tracking-tight leading-tight">
                {{ $project->title }}
            </h1>

            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mt-4 text-slate-500 text-sm sm:text-lg">
                <p><strong class="text-slate-700">Categoría: </strong>{{ $project->specialization->specialization ?? 'N/A' }}</p>
                <p><strong class="text-slate-700">Ubicación: </strong>{{ $project->ubication->ubicationName ?? 'N/A' }}</p>
                <p><strong class="text-slate-700">Tribunal: </strong>{{ $project->numTribunal }}</p>
            </div>
            
            <!-- Imagen Principal -->
            <div class="mt-8 flex justify-center">
                <div class="max-w-full sm:max-w-md lg:max-w-lg"> 
                    <img class="w-full h-auto max-h-64 sm:max-h-96 object-contain rounded-2xl shadow-lg border border-gray-100"
                        src="{{ ($project->photoName && $project->photoName !== 'por_defecto/proyecto_default.png') ? asset('storage/photos/' . $project->photoName) : asset('images/JornadaProyectos.jpg') }}" 
                        alt="{{ $project->title }}">
                </div>
            </div>

            <!-- Resumen -->
            <div class="mt-8 max-w-3xl mx-auto">
                <p class="text-gray-600 text-base sm:text-lg leading-relaxed break-words italic">
                    "{{ $project->abstract }}"
                </p>
            </div>

            <!-- Sección de Vídeo -->
            <div class="w-full max-w-3xl mt-10 mx-auto">
                <h3 class="font-bold text-xl text-slate-800 border-b border-slate-100 pb-3 mb-4">Vídeo de presentación</h3>

                @if ($project->videoURL)
                    <div class="aspect-video w-full rounded-2xl overflow-hidden bg-slate-900 shadow-2xl">
                        <iframe class="w-full h-full" src="{{ $project->embed_video_url }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <div class="bg-slate-50 rounded-2xl p-10 text-center border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 italic">Vídeo promocional no disponible</p>
                    </div>
                @endif
            </div>

            <!-- Botones de Enlace (Documentación / Moodle) -->
            <div class="mt-10 flex flex-col sm:flex-row justify-center items-center gap-4">
                @if ($project->idProject)
                    <a href="{{ route('project.pdf', $project->idProject) }}"
                        class="w-full sm:w-auto text-white bg-emerald-600 hover:bg-emerald-700 transition-all py-3 px-8 rounded-full text-sm font-bold shadow-md hover:scale-105">
                        Ver Ficha Técnica
                    </a>
                @endif

                @if((auth()->user()->idRole === 1 || auth()->user()->idRole === 4) && $project->moodleURL)
                    <a href="{{ $project->moodleURL }}" target="_blank"
                        class="w-full sm:w-auto bg-indigo-600 text-white py-3 px-8 rounded-full text-sm font-bold hover:bg-indigo-700 transition-all shadow-md hover:scale-105">
                        Acceder al curso Moodle
                    </a>
                @endif
            </div>
        </div>

        <!-- Sección de Equipo -->
        <div class="mt-8 bg-white p-6 rounded-2xl shadow-lg border border-gray-50">
            <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Equipo del proyecto
            </h2>

            @if($project->students->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($project->students as $student)
                        <div class="p-4 rounded-2xl hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 group">
                            <a href="{{ route('students.show', $student->idStudent) }}" class="flex items-center">
                                <div class="relative">
                                    <div class="w-16 h-16 bg-white rounded-full shadow-md border-2 border-white overflow-hidden flex items-center justify-center">
                                        <img class="w-full h-auto object-contain"
                                             src="{{ asset('storage/' . $student->photoName) }}" 
                                             alt="{{ $student->name }}"
                                             onerror="this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                                    </div>
                                    @if ($student->isTeamLeader)
                                        <span class="absolute -top-1 -right-1 bg-amber-400 text-white p-1 rounded-full shadow-sm" title="Líder del Proyecto">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        </span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <p class="font-bold text-slate-700 group-hover:text-blue-600 transition-colors">
                                        {{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}
                                    </p>
                                    @if ($student->isTeamLeader)
                                        <span class="text-[10px] uppercase tracking-wider font-extrabold text-amber-600">Líder</span>
                                    @else
                                        <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400">Participante</span>
                                    @endif
                                </div>
                                <svg class="ml-auto w-5 h-5 text-slate-300 group-hover:text-blue-400 transition-all transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-slate-400 italic py-4">No hay estudiantes asignados a este proyecto.</p>
            @endif
        </div>

        <!-- Botones de Navegación Final -->
        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
            <a href="javascript:history.back()" class="order-2 sm:order-1 text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 py-3 px-10 rounded-xl transition font-bold text-center">
                Volver al listado
            </a>
            @if(auth()->user()->idRole === 1)
                <a href="{{ route('projects.edit', $project->idProject) }}"
                    class="order-1 sm:order-2 text-white bg-blue-600 hover:bg-blue-700 py-3 px-10 rounded-xl transition font-bold shadow-lg hover:shadow-blue-200 text-center">
                    Editar Proyecto
                </a>
            @endif
        </div>
    </div>
@endsection