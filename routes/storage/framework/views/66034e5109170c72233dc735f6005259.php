<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?> <!-- Asegúrate de compilar Tailwind con Vite -->
</head>
<body class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
    <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> <!-- Superposición azul -->

    <div class="flex items-center justify-center h-full relative z-10">
        <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
            <img src="<?php echo e(asset('images/logoMonlau.png')); ?>" alt="Logo" class="mx-auto w-40 mb-2">
            <form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <h2 class="text-2xl font-bold text-center text-gray-800">Crear cuenta</h2>
                
                <!-- Campo Nombre -->
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-600">Nombre</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa tu nombre completo"
                        required>
                </div>

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

                <!-- Campo Contraseña -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-600">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa tu contraseña"
                        required>
                </div>

                <!-- Campo Verificar Contraseña -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Verificar Contraseña</label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Repite tu contraseña"
                        required>
                </div>

                <!-- Botón de Registro -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
                    Registrarse
                </button>

                <!-- Enlace a Login -->
                <p class="text-sm text-center text-gray-600">
                    ¿Ya tienes una cuenta? 
                    <a href="<?php echo e(route('login')); ?>" class="text-blue-500 hover:underline">Iniciar sesión</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/register.blade.php ENDPATH**/ ?>