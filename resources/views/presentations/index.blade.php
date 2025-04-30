@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-4xl font-bold text-blue-600 text-center">Lista de Presentaciones</h2>

    <!-- Botón para agregar una nueva presentación -->
    <div class="mt-6">
        <a href="{{ route('presentations.create') }}" class="bg-blue-500 text-white py-2 px-6 rounded-lg">Agregar Nueva Presentación</a>
    </div>

    <!-- Mostrar todas las presentaciones -->
    <ul class="mt-6 space-y-4">
        @foreach($presentations as $presentation)
            <li class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800">{{ $presentation->presentationName }}</h3>
                <p class="text-gray-600">{{ $presentation->topic }}</p>
                <p class="text-gray-500 text-sm">Hora de presentación: {{ \Carbon\Carbon::parse($presentation->presentationDate)->format('H:i') }}</p>
                <p class="text-gray-600">Ponentes:</p>
                @foreach ($presentation->speakers as $speaker)
                    <p class="text-gray-500 text-sm">{{ $speaker->name }} {{ $speaker->surname1 }} {{ $speaker->surname2 }}</p>
                @endforeach
                
                <!-- Enlace para editar la presentación -->
                <div class="mt-4">
                    <a href="{{ route('presentations.edit', $presentation->idPresentation) }}" class="text-blue-500">Editar</a>
                    |
                    <a href="{{ route('presentations.speaker', $presentation->idPresentation) }}" class="text-blue-500">Gestionar Ponentes</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
