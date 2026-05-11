@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-600 tracking-tight">Lista de Proyectos</h1>
    </div>

    @if(session('success'))
    <div class="max-w-2xl mx-auto mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between" role="alert">
        <span class="font-medium">{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="text-green-900">&times;</button>
    </div>
    @endif

    <div class="p-6 mb-8">
        <form method="GET" action="{{ route('projects.index') }}" class="flex flex-col gap-4">
            <div class="flex flex-wrap items-center justify-center gap-3">
                
                <select name="specialization" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todas las especializaciones</option>
                    @foreach($specializations as $specialization)
                    <option value="{{ $specialization->idSpecialization }}"
                        {{ request('specialization') == $specialization->idSpecialization ? 'selected' : '' }}>
                        {{ $specialization->specialization }}
                    </option>
                    @endforeach
                </select>

                <select name="curso" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todos los cursos</option>
                    @foreach($cursos as $curso)
                    <option value="{{ $curso }}" {{ request('curso') == $curso ? 'selected' : '' }}>
                        Curso {{ $curso }}
                    </option>
                    @endforeach
                </select>

                <div class="relative inline-block text-left w-full sm:w-auto" style="min-width: 200px;">
                    <button type="button" 
                        onclick="document.getElementById('menu-tipos').classList.toggle('hidden')"
                        class="w-full rounded-xl text-gray-600 px-4 py-2.5 bg-gray-50 flex items-center justify-between gap-2 border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"> 
                        <span>Tipos de proyecto</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="menu-tipos" class="hidden absolute z-20 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-xl p-3">
                        <div class="flex flex-col gap-2 max-h-60 overflow-y-auto custom-scrollbar">
                            @foreach($tipos as $id => $nombre)
                                <label class="flex items-center p-2 hover:bg-blue-50 rounded-lg cursor-pointer transition">
                                    <input 
                                        type="checkbox" 
                                        name="tipos[]" 
                                        value="{{ $id }}"
                                        class="form-checkbox h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                        {{ (is_array(request('tipos')) && in_array($id, request('tipos'))) ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 text-sm text-gray-700">{{ $nombre }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="mt-3 pt-2 border-t text-center">
                            <button type="button" 
                                onclick="document.getElementById('menu-tipos').classList.add('hidden'); this.form.submit()" 
                                class="text-xs text-blue-600 font-bold hover:text-blue-800 uppercase tracking-wider">
                                Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </div>

                <select name="numTribunal" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todos los tribunales</option>
                    <option value="sin_asignar" {{ request('numTribunal') == 'sin_asignar' ? 'selected' : '' }}>
                        Sin tribunal asignado
                    </option>
                    @for ($i = 1; $i <= 25; $i++)
                        <option value="{{ $i }}" {{ request('numTribunal') == "$i" ? 'selected' : '' }}>
                            Tribunal {{ $i }}
                        </option>
                    @endfor
                </select>

                <select name="idUbication" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todas las ubicaciones</option>
                    @foreach($ubications as $ubication)
                        <option value="{{ $ubication->idUbication }}" 
                            {{ request('idUbication') == $ubication->idUbication ? 'selected' : '' }}>
                            {{ $ubication->ubicationName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col sm:flex-row max-w-lg mx-auto w-full gap-2 mt-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre de alumno..." 
                    class="w-full sm:flex-grow border border-gray-300 rounded-xl px-4 py-2 text-gray-700 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none shadow-sm transition">
                <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white hover:bg-blue-700 px-6 py-2 rounded-xl font-bold transition shadow-md active:scale-95">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($projects as $project)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
            <div class="relative h-48 w-full">
                <img class="w-full h-full object-cover" 
                    src="{{ $project->photoName ? asset('storage/photos/' . $project->photoName) : asset('images/logoMonlau2026(2).png') }}" 
                    alt="{{ $project->title }}"
                    onerror="this.onerror=null; this.src='{{ asset('images/logoMonlau2026(2).png') }}';">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>

            <div class="p-6 flex flex-col flex-grow">
                <h2 class="text-xl font-bold text-gray-800 leading-tight mb-2 truncate" title="{{ $project->title }}">{{ $project->title }}</h2>
                <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed flex-grow">
                    {{ Str::limit($project->abstract, 100) }}
                </p>

                @if(auth()->user()->idRole === 1)
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 mb-4 space-y-3">
                        <form method="POST" action="{{ route('projects.updateTribunalUbication') }}">
                            @csrf
                            <input type="hidden" name="idProject" value="{{ $project->idProject }}">
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Tribunal</label>
                                <select name="numTribunal" class="border-gray-200 rounded-lg text-xs py-1.5 pl-2 pr-8 w-full bg-white focus:ring-2 focus:ring-blue-400" onchange="this.form.submit()">
                                    <option value="">No asignado</option> {{-- Opción para desasignar --}}
                                    @for ($i = 1; $i <= 25; $i++) {{-- Para aumentar los tribunales --}}
                                    <option value="{{ $i }}" {{ $project->numTribunal == $i ? 'selected' : '' }}>Tribunal {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                        
                        <form method="POST" action="{{ route('projects.updateTribunalUbication') }}">
                            @csrf
                            <input type="hidden" name="idProject" value="{{ $project->idProject }}">
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Ubicación</label>
                                <select name="idUbication" class="border-gray-200 rounded-lg text-xs py-1.5 pl-2 pr-8 w-full bg-white focus:ring-2 focus:ring-blue-400" onchange="this.form.submit()">
                                    <option value="">No asignada</option>
                                    @foreach($ubications as $ubication)
                                        <option value="{{ $ubication->idUbication }}" {{ $project->idUbication == $ubication->idUbication ? 'selected' : '' }}>
                                            {{ $ubication->ubicationName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('projects.show', $project->idProject) }}" 
                       class="flex-grow text-center bg-blue-600 text-white hover:bg-blue-700 py-2.5 rounded-xl font-bold text-sm shadow-sm transition active:scale-95">
                       Ver Detalles
                    </a>
                    @if(auth()->user()->idRole === 1)
                    <a href="{{ route('projects.edit', $project->idProject) }}" 
                       class="w-full sm:w-auto justify-center flex items-center bg-yellow-800 text-white hover:bg-yellow-900 px-4 py-2.5 rounded-xl text-sm transition shadow-sm active:scale-95">
                       Editar
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-12 text-center">
            <p class="text-gray-400 italic">No se han encontrado proyectos que coincidan con la búsqueda.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-10 w-full overflow-x-auto">
        {{ $projects->appends(request()->query())->links() }}
    </div>
</div>

<script>
    // Cerrar menú al hacer clic fuera
    window.addEventListener('click', function(e) {
        const menu = document.getElementById('menu-tipos');
        const button = e.target.closest('button');
        if (menu && !button && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
@endsection