<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center w-full">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="h-8 w-auto">
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex items-center">
                    <x-nav-link href="{{ route('students.index') }}" :active="request()->routeIs('students.index')"
                        class="whitespace-nowrap">
                        {{ __('Alumnos') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('projects.index') }}" :active="request()->routeIs('projects.index')"
                        class="whitespace-nowrap">
                        {{ __('Proyectos') }}
                    </x-nav-link>

                    @if(auth()->user()->idRole === 1)
                        <x-nav-link href="{{ route('mesas.index') }}" :active="request()->routeIs('mesas.index')"
                            class="whitespace-nowrap">
                            {{ __('Mesas') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('projects.upload_csv') }}"
                            :active="request()->routeIs('projects.upload_csv')" class="whitespace-nowrap">
                            {{ __('Subir Proyectos') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.solicitudes') }}"
                            :active="request()->routeIs('admin.solicitudes')" class="whitespace-nowrap">
                            {{ __('Solicitudes Empresa') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.empresas_aceptadas') }}"
                            :active="request()->routeIs('admin.empresas_aceptadas')" class="whitespace-nowrap">
                            {{ __('Empresas Aceptadas') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('presentations.index') }}"
                            :active="request()->routeIs('presentations.index')" class="whitespace-nowrap">
                            {{ __('Gestionar Ponencias') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.votes.index') }}"
                            :active="request()->routeIs('admin.votes.index')" class="whitespace-nowrap">
                            {{ __('Votos') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->idRole === 4)
                        <x-nav-link href="{{ route('teachers.myStudents') }}"
                            :active="request()->routeIs('teachers.myStudents')" class="whitespace-nowrap">
                            {{ __('Mis Alumnos') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->idRole === 3)
                        <x-nav-link href="{{ route('students.myProject') }}"
                            :active="request()->routeIs('students.myProject')" class="whitespace-nowrap">
                            {{ __('Mi Proyecto') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('students.myProfile') }}"
                            :active="request()->routeIs('students.myProfile')" class="whitespace-nowrap">
                            {{ __('Mi Currículum') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user()->idRole === 5)
                        <x-nav-link href="{{ route('admin.myProfile') }}" :active="request()->routeIs('admin.myProfile')"
                            class="whitespace-nowrap">
                            {{ __('Editar Datos') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->username }}
                                    <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">{{ __('Gestiona tu Cuenta') }}</div>
                            <x-dropdown-link href="{{ route('profile.show') }}">{{ __('Mi Perfil') }}</x-dropdown-link>
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">{{ __('Cerrar Sesión') }}</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('students.index') }}" :active="request()->routeIs('students.index')">
                {{ __('Alumnos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="{{ route('projects.index') }}" :active="request()->routeIs('projects.index')">
                {{ __('Proyectos') }}
            </x-responsive-nav-link>

            @if(auth()->user()->idRole === 1)
                <x-responsive-nav-link href="{{ route('mesas.index') }}" :active="request()->routeIs('mesas.index')">
                    {{ __('Mesas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('projects.upload_csv') }}"
                    :active="request()->routeIs('projects.upload_csv')">
                    {{ __('Subir Proyectos') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.solicitudes') }}"
                    :active="request()->routeIs('admin.solicitudes')">
                    {{ __('Solicitudes Empresa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.empresas_aceptadas') }}"
                    :active="request()->routeIs('admin.empresas_aceptadas')">
                    {{ __('Empresas Aceptadas') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('presentations.index') }}"
                    :active="request()->routeIs('presentations.index')">
                    {{ __('Gestionar Ponencias') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.votes.index') }}"
                    :active="request()->routeIs('admin.votes.index')">
                    {{ __('Votos') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->idRole === 4)
                <x-responsive-nav-link href="{{ route('teachers.myStudents') }}"
                    :active="request()->routeIs('teachers.myStudents')">
                    {{ __('Mis Alumnos') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->idRole === 3)
                <x-responsive-nav-link href="{{ route('students.myProject') }}"
                    :active="request()->routeIs('students.myProject')">
                    {{ __('Mi Proyecto') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('students.myProfile') }}"
                    :active="request()->routeIs('students.myProfile')">
                    {{ __('Mi Currículum') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->idRole === 5)
                <x-responsive-nav-link href="{{ route('admin.myProfile') }}"
                    :active="request()->routeIs('admin.myProfile')">
                    {{ __('Editar Datos') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="font-bold text-base text-blue-600 uppercase">{{ Auth::user()->username }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link href="{{ route('profile.show') }}">
                    {{ __('Mi Perfil') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>