@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-2xl md:text-3xl font-semibold text-blue-600">Ranking de Votos</h1>
        
        <form action="{{ route('admin.votes.toggle') }}" method="POST">
            @csrf
            <button type="submit" 
                class="px-6 py-2 rounded-lg font-bold text-white transition {{ $votingStatus ? 'bg-red-500' : 'bg-green-600' }}">
                {{ $votingStatus ? 'Desactivar Votaciones' : 'Activar Votaciones' }}
            </button>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <th class="border-b p-4 text-center">#</th>
                    <th class="border-b p-4 text-left">Proyecto</th>
                    <th class="border-b p-4 text-center">Votos</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($projects as $index => $project)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 text-center font-bold text-lg text-gray-500">
                        {{ $index + 1 }}
                    </td>
                    <td class="p-4">
                        <div class="font-semibold text-gray-800">{{ $project->title }}</div>
                        <div class="text-xs text-gray-500 italic">{{ $project->specialization->specialization ?? '' }}</div>
                    </td>
                    <td class="p-4 text-center">
                        <span class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-md font-black text-xl">
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