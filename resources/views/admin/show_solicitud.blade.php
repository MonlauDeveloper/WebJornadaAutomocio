@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Detalles de la Solicitud</h1>
    
    <!-- Información de la empresa -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-11/12 md:w-1/2 mx-auto">
        <h2 class="text-xl font-semibold text-center text-gray-800 mb-4">Información de la Empresa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p><strong class="font-bold text-gray-700">Nombre de Empresa:</strong> {{ $user->username }}</p>
                <p><strong class="font-bold text-gray-700">Email:</strong> {{ $user->email }}</p>
                <p><strong class="font-bold text-gray-700">Página web:</strong> 
                    <a href="{{ $user->company->companyWeb }}" class="text-blue-600 hover:text-blue-700" target="_blank" rel="noopener noreferrer">
                        {{ $user->company->companyWeb }}
                    </a>
                </p>
            </div>
            <div>
                <p><strong class="font-bold text-gray-700">Nombre del Asistente:</strong> {{ $user->company->asistenteNombre }} {{ $user->company->asistenteApellidos }}</p>
                <p><strong class="font-bold text-gray-700">Teléfono del Asistente:</strong> {{ $user->company->telefonoAsistente }}</p>
                <p><strong class="font-bold text-gray-700">Cargo del Asistente:</strong> {{ $user->company->cargoAsistente }}</p>

            </div>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="flex justify-center gap-4 mb-6">
        <form action="{{ route('admin.solicitudes.approve', $user->idUser) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-md shadow hover:bg-green-600 transition duration-300"
                onclick="return confirm('¿Estás seguro de que deseas aprobar esta solicitud?');">
                Aprobar
            </button>
        </form>

        <form action="{{ route('admin.solicitudes.deny', $user->idUser) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-md shadow hover:bg-red-600 transition duration-300"
                onclick="return confirm('¿Estás seguro de que deseas denegar esta solicitud?');">
                Denegar
            </button>
        </form>
    </div>

    <!-- Botón Volver Atrás -->
    <div class="flex justify-center">
        <a href="{{ route('admin.solicitudes') }}" class="bg-gray-500 text-white px-6 py-3 rounded-md shadow hover:bg-gray-600 transition duration-300">
            Volver Atrás
        </a>
    </div>
</div>
@endsection
