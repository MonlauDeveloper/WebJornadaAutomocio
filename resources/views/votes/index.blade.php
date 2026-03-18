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
        <h1 class="text-2xl md:text-3xl font-semibold text-blue-600 text-center md:text-left">Ranking de Votos</h1>
        
        <form action="{{ route('admin.votes.toggle') }}" method="POST" class="w-full md:w-auto text-center">
            @csrf
            <button type="submit" 
                class="w-full md:w-auto px-6 py-2 rounded-lg font-bold text-white transition {{ $votingStatus ? 'bg-red-500' : 'bg-green-600' }}">
                {{ $votingStatus ? 'Desactivar Votaciones' : 'Activar Votaciones' }}
            </button>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg border border-gray-200 overflow-x-auto">
        <table class="w-full border-collapse min-w-[600px] md:min-w-full"> <thead>
                <tr class="bg-gray-100 text-gray-700 text-xs md:text-sm uppercase">
                    <th class="border-b p-3 md:p-4 text-center">#</th>
                    <th class="border-b p-3 md:p-4 text-left">Proyecto</th>
                    <th class="border-b p-3 md:p-4 text-center">Votos</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($projects as $index => $project)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 md:p-4 text-center font-bold text-base md:text-lg text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="p-3 md:p-4">
                        <div class="font-semibold text-sm md:text-base text-gray-800 break-words">{{ $project->title }}</div>
                        <div class="text-[10px] md:text-xs text-gray-500 italic">{{ $project->specialization->specialization ?? '' }}</div>
                    </td>
                    <td class="p-3 md:p-4 text-center">
                        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 md:px-4 md:py-1 rounded-md font-black text-lg md:text-xl">
                            {{ $project->votes_count }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-10 text-center text-gray-400 italic">
                        No hay proyectos con votos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection