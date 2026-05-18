<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monlau</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('images/favi2020.png') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        .header-spacer {
            height: 30px;
        }

        main {
            padding-top: 50px !important;
            margin-top: 30px !important;
        }

        /* Ajuste extra para móviles: si el menú es muy largo, permite scroll horizontal suave */
        @media (max-width: 640px) {
            nav {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-r from-blue-50 to-white text-gray-700">
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-7xl px-4 lg:px-12">
            
            <header class="flex flex-col md:flex-row justify-between items-center py-4 fixed top-0 left-0 right-0 bg-white z-50 shadow-lg px-4">
                <div class="md:ml-12 flex items-center mb-4 md:mb-0">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto h-8">
                    </a>
                </div>

                @if (Route::has('login'))
                    <nav class="md:mr-12 flex items-center justify-center space-x-4 md:space-x-6 text-sm md:text-base">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-800 transition duration-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-800 transition duration-300">Iniciar Sesión</a>
                            <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-800 transition duration-300">Crear cuenta</a>
                            <a href="{{ route('register-empresa') }}" class="text-gray-700 hover:text-gray-800 transition duration-300 font-medium">Empresas</a>
                        @endauth
                    </nav>
                @endif
            </header>

            <div class="header-spacer"></div>

            <main class="text-center px-2" style="padding-top: 15px !important;">
                <section class="mt-16 md:mt-8">
                    <h1 class="text-2xl md:text-4xl font-semibold text-blue-800 mb-4">
                        V Jornada de la Automoción 2026
                    </h1>
                    <p class="text-sm md:text-lg text-gray-700 max-w-3xl mx-auto mb-6">
                        Un evento único para aprender, conectar y crecer. Más de 800 alumnos presentarán sus proyectos finales, junto con ponencias y demostraciones del mundo de la automoción.
                    </p>
                    <p class="text-xs md:text-md text-gray-600 font-bold bg-blue-100 py-2 px-4 rounded-full inline-block">
                        📅 Miércoles 3 de junio | 📍 Nürburgreen Indoor
                    </p>
                </section>

                <section class="py-8">
                    <h2 class="text-xl md:text-2xl font-semibold text-blue-800 mb-4">Mapa del evento</h2>
                    <img src="{{ asset('images/Mapa_Jornada.png') }}" alt="Mapa del evento" class="mx-auto w-full max-w-4xl rounded-lg shadow-lg">
                </section>
            </main>
            
        </div>
    </div>
</body>

</html>