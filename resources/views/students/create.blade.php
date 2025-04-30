@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Crear Nuevo Estudiante</h1>

    <form action="{{ route('students.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Apellido 1 -->
        <div class="mb-4">
            <label for="surname1" class="block text-gray-700 font-semibold mb-2">Primer Apellido</label>
            <input type="text" name="surname1" id="surname1" value="{{ old('surname1') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('surname1')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Apellido 2 -->
        <div class="mb-4">
            <label for="surname2" class="block text-gray-700 font-semibold mb-2">Segundo Apellido</label>
            <input type="text" name="surname2" id="surname2" value="{{ old('surname2') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('surname2')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Especialización -->
        <div class="mb-4">
            <label for="idSpecialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
            <select name="idSpecialization" id="idSpecialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization->idSpecialization }}">{{ $specialization->specialization }}</option>
                @endforeach
            </select>
            @error('idSpecialization')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Curso -->
        <div class="mb-4">
            <label for="course" class="block text-gray-700 font-semibold mb-2">Curso</label>
            <select name="course" id="course" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="A" >A</option>           
                <option value="B" >B</option>           
                <option value="C" >C</option>           
                <option value="D" >D</option>           
                <option value="E" >E</option>           
                <option value="F" >F</option>           
                <option value="R" >R</option>           
                <option value="ONLINE" selected>ONLINE</option>  
            </select>         
            @error('course')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Equipo -->
        <div class="mb-4">
            <label for="team" class="block text-gray-700 font-semibold mb-2">Equipo (opcional)</label>
            <input type="text" name="team" id="team" value="{{ old('team') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
        </div>

        <!-- Proyecto -->
        <div class="mb-4">
            <label for="project" class="block text-gray-700 font-semibold mb-2">Proyecto (opcional)</label>
            <select name="idProject" id="idProject" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" onchange="toggleProjectForm()">
                <!-- Opción nula -->
                <option value="" selected>Nulo</option>
                <option value="new_project">Crear proyecto nuevo</option>
                <!-- Opciones de proyectos -->
                @foreach($projects as $project)
                    <option value="{{ $project->idProject }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Formulario para crear proyecto nuevo -->
        <div id="newProjectForm" class="hidden">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Crear Nuevo Proyecto</h2>

            <!-- Título del Proyecto -->
            <div class="mb-4">
                <label for="project_title" class="block text-gray-700 font-semibold mb-2">Título del Proyecto</label>
                <input type="text" name="project_title" id="project_title" value="{{ old('project_title') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                @error('project_title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Especialización del Proyecto -->
            <div class="mb-4">
                <label for="project_specialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
                <select name="project_specialization" id="project_specialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    @foreach($specializations as $specialization)
                        <option value="{{ $specialization->idSpecialization }}">{{ $specialization->specialization }}</option>
                    @endforeach
                </select>
                @error('project_specialization')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Curso del Proyecto -->
            <div class="mb-4">
                <label for="project_course" class="block text-gray-700 font-semibold mb-2">Curso</label>
                <select name="project_course" id="project_course" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="A" >A</option>           
                    <option value="B" >B</option>           
                    <option value="C" >C</option>           
                    <option value="D" >D</option>           
                    <option value="E" >E</option>           
                    <option value="F" >F</option>           
                    <option value="R" >R</option>           
                    <option value="ONLINE" selected>ONLINE</option>  
                </select>         
                @error('project_course')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Ubicación del Proyecto -->
            <div class="mb-4">
                <label for="project_ubication" class="block text-gray-700 font-semibold mb-2">Ubicación (opcional)</label>
                <select name="project_ubication" id="project_ubication" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="" selected>Seleccionar Ubicación</option>
                    @foreach($ubications as $ubication)
                    <option value="{{ $ubication->idUbication }}">{{ $ubication->ubicationName }}</option>
                @endforeach
                </select>
                @error('project_ubication')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Número de Tribunal -->
            <div class="mb-4">
                <label for="project_numTribunal" class="block text-gray-700 font-semibold mb-2">Número de Tribunal (opcional)</label>
                <select name="project_numTribunal" id="project_numTribunal" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="">Seleccionar Tribunal</option>
                    @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}">Tribunal {{ $i }}</option>
                    @endfor
                </select>
                @error('project_numTribunal')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Botón -->
        <div class="mt-6">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 py-2.5 px-4 rounded-lg">Crear Estudiante</button>
        </div>

    </form>
</div>

<script>
    function toggleProjectForm() {
        var projectSelect = document.getElementById('idProject');
        var newProjectForm = document.getElementById('newProjectForm');
        if (projectSelect.value === 'new_project') {
            newProjectForm.classList.remove('hidden');
        } else {
            newProjectForm.classList.add('hidden');
        }
    }
</script>
@endsection