<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Monlau</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favi2020.png')); ?>">

    <!-- Styles / Scripts -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Estilos inline para asegurar que se apliquen -->
    <style>
        .header-spacer {
            height: 30px;
            /* Altura fija para el espaciador */
        }

        main {
            padding-top: 50px !important;
            /* Forzar padding con !important */
            margin-top: 30px !important;
            /* Añadir margen adicional */
        }
    </style>
</head>

<body class="font-sans antialiased bg-gradient-to-r from-blue-50 to-white text-gray-700">
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-7xl px-6 lg:px-12">
            <!-- Header -->
            <header class="flex justify-between items-center py-4 fixed top-0 left-0 right-0 bg-white z-50 shadow-lg">
                <div class="ml-12 flex items-center space-x-4">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <img src="<?php echo e(asset('images/logoMonlau.png')); ?>" alt="Logo" class="mx-auto h-8 mb-2">
                    </a>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('login')): ?>
                    <nav class="mr-12 flex space-x-6">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/dashboard')); ?>"
                                class="text-gray-700 hover:text-gray-800 transition duration-300">Dashboard</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>"
                                class="text-gray-700 hover:text-gray-800 transition duration-300">Iniciar Sesión</a>
                            <a href="<?php echo e(route('register')); ?>"
                                class="text-gray-700 hover:text-gray-800 transition duration-300">Crear cuenta</a>
                            <a href="<?php echo e(route('register-empresa')); ?>"
                                class="text-gray-700 hover:text-gray-800 transition duration-300">Crear cuenta de Empresa</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </nav>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </header>

            <!-- Espaciador dedicado para el header -->
            <div class="header-spacer"></div>

            <!-- Main Section -->
            <main class="text-center" style="padding-top: 15px !important;">
                <!-- Introduction Section -->
                <section class="px-6 mt-8">
                    <h1 class="text-4xl font-semibold text-blue-800 mb-4">IV Jornada de la Automoción 2025</h1>
                    <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-6">
                        Un evento único para aprender, conectar y crecer. Más de 800 alumnos presentarán sus proyectos
                        finales,
                        junto con ponencias y demostraciones del mundo de la automoción.
                    </p>
                    <p class="text-md text-gray-600">¡Te esperamos el martes 27 de mayo en Nürburgreen Indoor!</p>
                </section>

                <!-- Map Section -->
                <section class="py-8 px-6">
                    <h2 class="text-2xl font-semibold text-blue-800 mb-4">Mapa del evento</h2>
                    <img src="<?php echo e(asset('images/Mapa_Jornada.png')); ?>" alt="Mapa del evento"
                        class="mx-auto w-full max-w-4xl rounded-lg shadow-lg">
                </section>

                <!-- 
                <section class="px-6 pb-12">
                    <h2 class="text-2xl font-semibold text-blue-800 mb-4">Descarga nuestra app</h2>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="https://apps.apple.com/es/app/app-jornada-de-lautomoci%C3%B3/id6743483372"
                            style="display: inline-block; background-color: #000; color: white; border-radius: 8px; padding: 8px 16px; text-decoration: none; min-width: 160px;">
                            <div style="display: flex; align-items: center;">
                                <div style="margin-right: 8px;">
                                    <img src="<?php echo e(asset('images/apple_logo.png')); ?>" alt="Apple"
                                        style="width: 24px; height: 24px;">
                                </div>
                                <div>
                                    <div style="font-size: 12px; font-weight: 300;">Consíguelo en el</div>
                                    <div style="font-size: 18px; font-weight: 600; line-height: 1.2;">App Store</div>
                                </div>
                            </div>
                        </a>

                        <a href="https://play.google.com/store/apps/details?id=com.monlau.app_maquinista&pcampaignid=web_share"
                            style="display: inline-block; background-color: #000; color: white; border-radius: 8px; padding: 8px 16px; text-decoration: none; min-width: 160px;">
                            <div style="display: flex; align-items: center;">
                                <div style="margin-right: 8px;">
                                    <img src="<?php echo e(asset('images/android_logo.png')); ?>" alt="Google Play"
                                        style="width: 24px; height: 24px;">
                                </div>
                                <div>
                                    <div style="font-size: 12px; font-weight: 300;">Disponible en</div>
                                    <div style="font-size: 18px; font-weight: 600; line-height: 1.2;">Google Play</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </section>
    -->

            </main>
        </div>
    </div>
</body>

</html><?php /**PATH /var/www/jornada-automocion-api/resources/views/welcome.blade.php ENDPATH**/ ?>