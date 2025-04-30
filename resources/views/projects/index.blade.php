@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Lista de Proyectos</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Filtros: Especialización, Curso, Tribunal y Ubicación -->
    <div class="mb-6">
        <form method="GET" action="{{ route('projects.index') }}" class="flex flex-wrap items-center justify-center gap-4">
            <!-- Filtro por especialización -->
            <select name="specialization" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todas las especializaciones</option>
                @foreach($specializations as $specialization)
                <option value="{{ $specialization->idSpecialization }}"
                    {{ request('specialization') == $specialization->idSpecialization ? 'selected' : '' }}>
                    {{ $specialization->specialization }}
                </option>
                @endforeach
            </select>

            <!-- Filtro por curso -->
            <select name="curso" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todos los cursos</option>
                @foreach($cursos as $curso)
                <option value="{{ $curso }}" {{ request('curso') == $curso ? 'selected' : '' }}>
                    Curso {{ $curso }}
                </option>
                @endforeach
            </select>

            <!-- Filtro por número de tribunal -->
            <select name="numTribunal" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todos los tribunales</option>
                @for ($i = 1; $i <= 20; $i++)
                <option value="{{ $i }}" {{ request('numTribunal') == $i ? 'selected' : '' }}>
                    Tribunal {{ $i }}
                </option>
                @endfor
            </select>

            <!-- Filtro por ubicación -->
            <select name="idUbication" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todas las ubicaciones</option>
                @foreach($ubications as $ubication)
                    <option value="{{ $ubication->idUbication }}" 
                        {{ request('idUbication') == $ubication->idUbication ? 'selected' : '' }}>
                        {{ $ubication->ubicationName }}
                    </option>
                @endforeach
            </select>

            <!-- Filtro por nombre de estudiante -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre de Alumno" class="border rounded-lg px-4 py-2 text-gray-700">

            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">Buscar</button>
        </form>
    </div>

    <!-- Listado de proyectos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
            <div class="mb-4">
                <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('storage/photos/' . $project->photoName) }}" alt="{{ $project->title }}">
            </div>
            <h2 class="text-2xl font-bold text-blue-500">{{ $project->title }}</h2>
            <p class="text-gray-600 mt-2">{{ Str::limit($project->abstract, 100) }}</p>

            @if(auth()->user()->idRole === 1)
                <!-- Formulario para actualizar Tribunal -->
                <div class="mt-4">
                    <form method="POST" action="{{ route('projects.updateTribunalUbication') }}">
                        @csrf
                        <input type="hidden" name="idProject" value="{{ $project->idProject }}">
                        
                        <div class="mb-2">
                            <select 
                                id="tribunal-{{ $project->idProject }}" 
                                name="numTribunal" 
                                class="border rounded-lg text-gray-700 w-full"
                                onchange="this.form.submit()"
                            >
                                <option value="">Asignar Tribunal</option>
                                @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ $project->numTribunal == $i ? 'selected' : '' }}>
                                    Tribunal {{ $i }}
                                </option>
                                @endfor
                            </select>
                        </div>
                    </form>
                    
                    <!-- Formulario para actualizar Ubicación -->
                    <form method="POST" action="{{ route('projects.updateTribunalUbication') }}">
                        @csrf
                        <input type="hidden" name="idProject" value="{{ $project->idProject }}">
                        
                        <div>
                            <select 
                                id="ubication-{{ $project->idProject }}" 
                                name="idUbication" 
                                class="border rounded-lg text-gray-700 w-full"
                                onchange="this.form.submit()"
                            >
                                <option value="">Asignar Ubicación</option>
                                @foreach($ubications as $ubication)
                                    <option value="{{ $ubication->idUbication }}" 
                                        {{ $project->idUbication == $ubication->idUbication ? 'selected' : '' }}>
                                        {{ $ubication->ubicationName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('projects.show', $project->idProject) }}" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">Ver Detalles</a>
                @if(auth()->user()->idRole === 1)
                    <a href="{{ route('projects.edit', $project->idProject) }}" class="text-white bg-yellow-800 hover:bg-yellow-900 py-2 px-4 rounded-lg">Editar</a>
                @endif
            </div>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500">No hay proyectos disponibles para tu busqueda.</p>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="items-center justify-center mt-6">
        {{ $projects->appends(['specialization' => request('specialization'), 'curso' => request('curso')])->links() }}
    </div>
</div>
@endsection

