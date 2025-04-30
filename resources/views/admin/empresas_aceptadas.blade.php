@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-4">Empresas Aceptadas</h1>
    <div class="flex items-center justify-center mt-4 mb-4">
        <button type="button" onclick="window.location.href='{{ route('admin.create') }}'" class="bg-blue-500 text-white hover:bg-blue-600 px-4 py-2 rounded-lg">Agregar nueva Empresa</button>
    </div>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-3 px-4 text-left">Nombre de Empresa</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes as $solicitud)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $solicitud->username }}</td>
                    <td class="px-4 py-2">{{ $solicitud->email }}</td>
                    <td class="px-4 py-2 flex justify-center gap-2">
                        <!-- Botón para ver detalles -->
                        <a href="{{ route('admin.aprobadas_show', $solicitud->idUser) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Ver Detalles</a>

                        <!-- Botón de Editar -->
                        <a href="{{ route('admin.edit', $solicitud->idUser) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition duration-300">Editar</a>

                        <!-- Botón de Denegar -->
                        <form action="{{ route('admin.solicitudes.deny', $solicitud->idUser) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-300"
                                onclick="return confirm('¿Estás seguro de que deseas denegar esta Empresa?');">
                                Denegar
                            </button>             
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Mostrar los enlaces de paginación -->
<div class="mt-4">
    {{ $solicitudes->links() }}
</div>
@endsection
