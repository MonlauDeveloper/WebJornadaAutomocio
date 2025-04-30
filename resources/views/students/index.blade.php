@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Lista de Estudiantes</h1>

    <!-- Filtro de especialización y Buscador por nombre -->
    <div class="mb-6">
        <form method="GET" action="{{ route('students.index') }}" class="flex items-center justify-center gap-4">
            <select name="specialization" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todas las especializaciones</option>
                @foreach($specializations as $specialization)
                <option value="{{ $specialization->idSpecialization }}" 
                    {{ request('specialization') == $specialization->idSpecialization ? 'selected' : '' }}>
                    {{ $specialization->specialization }}
                </option>
                @endforeach
            </select>
            <select name="curso" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todos los cursos</option>
                @foreach($cursos as $curso)
                <option value="{{ $curso }}" 
                    {{ request('curso') == $curso ? 'selected' : '' }}>
                    Curso {{ $curso }}
                </option>
                @endforeach
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre" class="border rounded-lg px-4 py-2 text-gray-700">
            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">Buscar</button>
        </form>
        
        @if(auth()->user()->idRole === 1)
        <div class="flex items-center justify-center mt-4">
            <button type="button" onclick="window.location.href='{{ route('students.create') }}'" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">Agregar nuevo Alumno</button>
        </div>
        @endif
    </div>

    <!-- Botón para cambiar la vista -->
<div class="text-center mb-4">
    <button id="toggleView" class="bg-gray-600 text-white px-4 py-2 rounded-lg">
        Cambiar Vista
    </button>
</div>

<!-- Lista de estudiantes -->
<div id="gridView" class="{{ request('view') == 'list' ? 'hidden' : '' }} grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($students as $student)
    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
        <div class="mb-4">
            <img class="w-32 h-32 object-cover rounded-full mx-auto" src="{{ $student->photoName }}" alt="{{ $student->name }}" onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
        </div>
        <h2 class="text-2xl font-bold text-blue-500 text-center">{{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}</h2>
        <p class="text-gray-600 mt-2 text-center">{{ Str::limit($student->introduction, 100) }}</p>
        <div class="mt-4 text-center">
            <a href="{{ route('students.show', $student->idStudent) }}" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">Ver Detalles</a>
            @if(auth()->user()->idRole === 1)
                <a href="{{ route('students.edit', $student->idStudent) }}" class="text-white bg-yellow-800 hover:bg-yellow-900 py-2 px-4 rounded-lg">Editar</a>
            @endif
        </div>
    </div>
    @empty
    <p class="col-span-full text-center text-gray-500">No hay estudiantes disponibles.</p>
    @endforelse
</div>

<!-- Vista de lista compacta (oculta por defecto) -->
<div id="listView" class="{{ request('view') == 'list' ? '' : 'hidden' }}">
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-3">Foto</th>
                <th class="border p-3">Nombre</th>
                <th class="border p-3">Curso</th>
                <th class="border p-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr class="border">
                <td class="border p-3 text-center">
                    <img class="w-16 h-16 object-cover rounded-full mx-auto" src="{{ $student->photoName }}" alt="{{ $student->name }}" onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                </td>
                <td class="border p-3">{{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}</td>
                <td class="border p-3 text-center">{{ $student->curso }}</td>
                <td class="border p-3 text-center">
                    <a href="{{ route('students.show', $student->idStudent) }}" class="text-blue-600 hover:underline">Ver</a>
                    @if(auth()->user()->idRole === 1)
                        | <a href="{{ route('students.edit', $student->idStudent) }}" class="text-yellow-700 hover:underline">Editar</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-3">No hay estudiantes disponibles.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación con vista persistente -->
<div class="items-center justify-center mt-6">
    {{ $students->appends(['specialization' => request('specialization'), 'search' => request('search'), 'curso' => request('curso'), 'view' => request('view')])->links() }}
</div>

<!-- Script para alternar entre vistas -->
<script>
    document.getElementById('toggleView').addEventListener('click', function () {
        let currentView = "{{ request('view', 'grid') }}";
        let newView = currentView === 'grid' ? 'list' : 'grid';

        let url = new URL(window.location.href);
        url.searchParams.set('view', newView);
        window.location.href = url.toString();
    });
</script>

@endsection
