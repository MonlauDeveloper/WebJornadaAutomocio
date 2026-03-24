@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 md:p-6"> @if(session('success'))
        <div id="status-message" class="mb-4 transition-opacity duration-500">
            <div class="px-4 py-3 rounded-lg border {{ $votingStatus ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700' }} shadow-sm">
                <div class="flex items-center text-sm md:text-base"> <span class="mr-2">{{ $votingStatus ? '✅' : '🚫' }}</span>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            </div>
        </div>

        <script>
            setTimeout(function() {
                const message = document.getElementById('status-message');
                if (message) {
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <h1 class="text-2xl md:text-3xl font-semibold text-blue-600 text-center md:text-left">
        Ranking de Votos
    </h1>
    
    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
        
        <form action="{{ route('admin.votes.toggle') }}" method="POST" class="w-full md:w-auto text-center">
            @csrf
            <button type="submit" 
                class="w-full md:w-auto px-6 py-2 rounded-lg font-bold text-white transition {{ $votingStatus ? 'bg-red-500' : 'bg-green-600' }}">
                {{ $votingStatus ? 'Desactivar Votaciones' : 'Activar Votaciones' }}
            </button>
        </form>

        <form action="{{ route('admin.votes.reset') }}" method="POST" class="w-full md:w-auto" 
              onsubmit="return confirm('⚠️ ¿ESTÁS SEGURO? Se borrarán TODOS los votos permanentemente.');">
            @csrf
            <button type="submit" 
                class="w-full md:w-auto px-6 py-2 rounded-lg font-bold text-white transition bg-blue-600 shadow-md hover:bg-blue-700">
                Reiniciar Votaciones
            </button>
        </form>
        
    </div>
</div>

    <div class="bg-white shadow-md rounded-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
    <thead class="bg-blue-100">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posición</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proyecto</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Votos</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Detalles</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($projects as $index => $project)
        <tr>
            <td class="px-6 py-4 font-bold text-blue-600">#{{ $index + 1 }}</td>
            <td class="px-6 py-4">
                <div class="font-medium text-gray-900">{{ $project->title }}</div>
                <div class="text-sm text-gray-500">{{ $project->specialization->specialization }}</div>
            </td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full font-bold">
                    {{ $project->votes_count }} votos
                </span>
            </td>
            <td class="px-6 py-4 text-center">
                <a href="{{ route('projects.show', $project->idProject) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold rounded transition">
                   Ver Proyecto
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
</div>
@endsection