@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Editar Estudiante</h1>

    <form action="{{ route('students.update', $student->idStudent) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Apellido 1 -->
        <div class="mb-4">
            <label for="surname1" class="block text-gray-700 font-semibold mb-2">Primer Apellido</label>
            <input type="text" name="surname1" id="surname1" value="{{ old('surname1', $student->surname1) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('surname1')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Apellido 2 -->
        <div class="mb-4">
            <label for="surname2" class="block text-gray-700 font-semibold mb-2">Segundo Apellido</label>
            <input type="text" name="surname2" id="surname2" value="{{ old('surname2', $student->surname2) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('surname2')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Foto -->
        <div class="mb-4">
            <label for="photoName" class="block text-lg font-semibold text-blue-500">Foto</label>
            <input type="text" name="photoName" id="photoName" value="{{ old('photoName', $student->photoName) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('photoName')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Proyecto -->
        <div class="mb-4">
            <label for="idProject" class="block text-gray-700 font-semibold mb-2">Proyecto</label>
            <select name="idProject" id="idProject" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                @foreach($projects as $project)
                    <option value="{{ $project->idProject }}" {{ old('idProject', $student->idProject) == $project->idProject ? 'selected' : '' }}>
                        {{ $project->title }}
                    </option>
                @endforeach
            </select>
            @error('idProject')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Introducción -->
        <div class="mb-4">
            <label for="introduction" class="block text-gray-700 font-semibold mb-2">Introducción</label>
            <textarea name="introduction" id="introduction" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">{{ old('introduction', $student->introduction) }}</textarea>
            @error('introduction')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- CV Link -->
        <div class="mb-4">
            <label for="cvLink" class="block text-gray-700 font-semibold mb-2">CV Link</label>
            <input type="text" name="cvLink" id="cvLink" value="{{ old('cvLink', $student->cvLink) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('cvLink')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Líder de Equipo -->
        <div class="mb-4">
            <label for="isTeamLeader" class="block text-gray-700 font-semibold mb-2">Líder de Equipo</label>
            <input type="checkbox" name="isTeamLeader" id="isTeamLeader" value="1" {{ old('isTeamLeader', $student->isTeamLeader) ? 'checked' : '' }} class="w-4 h-4 border-gray-300 rounded">
            @error('isTeamLeader')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>


        <!-- Especialización -->
        <div class="mb-4">
            <label for="idSpecialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
            <select name="idSpecialization" id="idSpecialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                @foreach($specializations as $specialization)
                    <option value="{{ $specialization->idSpecialization }}" {{ old('idSpecialization', $student->idSpecialization) == $specialization->idSpecialization ? 'selected' : '' }}>
                        {{ $specialization->specialization }}
                    </option>
                @endforeach
            </select>
            @error('idSpecialization')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Curso -->
        <div class="mb-4">
            <label for="curso" class="block text-gray-700 font-semibold mb-2">Curso</label>
            <select name="curso" id="curso" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="A" {{ old('curso', $student->curso) == 'A' ? 'selected' : '' }}>A</option>           
                <option value="B" {{ old('curso', $student->curso) == 'B' ? 'selected' : '' }}>B</option>           
                <option value="C" {{ old('curso', $student->curso) == 'C' ? 'selected' : '' }}>C</option>           
                <option value="D" {{ old('curso', $student->curso) == 'D' ? 'selected' : '' }}>D</option>           
                <option value="E" {{ old('curso', $student->curso) == 'E' ? 'selected' : '' }}>E</option>           
                <option value="F" {{ old('curso', $student->curso) == 'F' ? 'selected' : '' }}>F</option>           
                <option value="R" {{ old('curso', $student->curso) == 'R' ? 'selected' : '' }}>R</option>           
                <option value="ONLINE" {{ old('curso', $student->curso) == 'ONLINE' ? 'selected' : '' }}>ONLINE</option>  
            </select>       
            @error('curso')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Equipo -->
        <div class="mb-4">
            <label for="idTeam" class="block text-gray-700 font-semibold mb-2">Equipo</label>
            <input type="text" name="idTeam" id="idTeam" value="{{ old('idTeam', $student->idTeam) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            @error('idTeam')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="mt-6">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 py-2.5 px-4 rounded-lg">Guardar Cambios</button>
    </form>
            <form action="{{ route('students.destroy', $student->idStudent) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="mt-2 mb-4 text-white bg-red-800 hover:bg-red-900 py-2.5 px-4 rounded-lg" onclick="return confirm('¿Estás seguro que quieres eliminar este estudiante?');">Eliminar</button>
            </form>
            <a href="javascript:history.back()" class="mt-2 text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">Volver Atrás</a>
        </div>

</div>
@endsection
