<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?> <!-- Asegúrate de compilar Tailwind con Vite -->
</head>
<body class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
    <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> <!-- Superposición azul -->

    <div class="flex items-center justify-center h-full relative z-10">
        <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
            <img src="<?php echo e(asset('images/logoMonlau.png')); ?>" alt="Logo" class="mx-auto w-40 mb-2">
            <form action="<?php echo e(route('password.email')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <h2 class="text-2xl font-bold text-center text-gray-800">Recuperar Contraseña</h2>
                
                <p class="text-sm text-center text-gray-600">
                    Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                </p>

                <!-- Campo Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa tu correo electrónico"
                        required>
                </div>

                <!-- Botón de Enviar -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
                    Enviar enlace
                </button>

                <!-- Enlace a Iniciar Sesión -->
                <p class="text-sm text-center text-gray-600">
                    ¿Recuerdas tu contraseña? 
                    <a href="<?php echo e(route('login')); ?>" class="text-blue-500 hover:underline">Iniciar sesión</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/forgot-password.blade.php ENDPATH**/ ?>