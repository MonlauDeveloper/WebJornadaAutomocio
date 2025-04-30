<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Monlau</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="<?php echo e(asset('images/favi2020.png')); ?>">

        <!-- Styles / Scripts -->
        <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
            <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php endif; ?>
    </head>
    <body class="font-sans antialiased bg-gradient-to-r from-blue-50 to-white text-gray-700">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-7xl px-6 lg:px-12">
                <!-- Header -->
                <header class="flex justify-between items-center py-4 fixed top-0 left-0 right-0 bg-white z-50 shadow-lg">
                    <!-- Logo -->
                    <div class="ml-12 flex items-center space-x-4">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <img src="<?php echo e(asset('images/logoMonlau.png')); ?>" alt="Logo" class="mx-auto h-8 mb-2">
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <?php if(Route::has('login')): ?>
                        <nav class="mr-12 flex space-x-6">
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(url('/dashboard')); ?>" class="text-gray-700 hover:text-gray-800 transition duration-300">Dashboard</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-gray-800 transition duration-300">Iniciar Sesión</a>
                                <a href="<?php echo e(route('register')); ?>" class="text-gray-700 hover:text-gray-800 transition duration-300">Crear cuenta</a>
                                <a href="<?php echo e(route('register-empresa')); ?>" class="text-gray-700 hover:text-gray-800 transition duration-300">Crear cuenta de Empresa</a>
                            <?php endif; ?>
                        </nav>
                    <?php endif; ?>
                </header>

                <!-- Main Section -->
                <main>
                    <!-- Hero Section -->
                    <section class="bg-blue-100 text-center py-24 px-6 rounded-lg shadow-xl mt-4">
                        <h1 class="text-4xl font-semibold text-blue-800 mb-4 animate__animated animate__fadeIn">Bienvenidos al Colegio Monlau</h1>
                        <p class="text-lg text-blue-600 mb-6 animate__animated animate__fadeIn animate__delay-1s">Formación profesional de calidad para tu futuro.</p>
                        <a href="#about" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 animate__animated animate__fadeIn animate__delay-2s">Descubre más</a>
                    </section>

                    <!-- About Section (example) -->
                    <section id="about" class="py-24 bg-white text-center">
                        <h2 class="text-3xl font-semibold text-blue-800 mb-4">¿Por qué elegirnos?</h2>
                        <p class="text-lg text-gray-600 max-w-4xl mx-auto mb-6">En Monlau, nos dedicamos a proporcionar una educación práctica y moderna, adaptada a las necesidades del mercado laboral actual, preparándote para afrontar cualquier reto en tu carrera profesional.</p>
                        <a href="#contact" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Contáctanos</a>
                    </section>
                </main>
            </div>
        </div>
        <!-- Footer -->
        <footer class="py-4 w-full text-center text-sm text-white bg-gray-600 mt-16">
            Monlau 2025
        </footer>
    </body>
</html>
<?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/welcome.blade.php ENDPATH**/ ?>