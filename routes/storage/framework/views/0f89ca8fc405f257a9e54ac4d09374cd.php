<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="h-screen bg-cover bg-center relative" style="background-image: url('/images/ImagenFondo.webp')">
    <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

    <div class="flex items-center justify-center h-full relative z-10">
        <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
            <img src="<?php echo e(asset('images/logoMonlau.png')); ?>" alt="Logo" class="mx-auto w-40 mb-2">
            <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                <h2 class="text-2xl font-bold text-center text-gray-800">Iniciar sesión</h2>
                
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa tu email"
                        required>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-600">Contraseña</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                            placeholder="Ingresa tu contraseña"
                            required>
                        <span 
                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer"
                            onclick="togglePassword()">
                            <i id="eyeIcon" class="fas fa-eye-slash"></i> 
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="text-blue-500 rounded">
                        <span>Recordarme</span>
                    </label>
                    <a href="<?php echo e(route('forgot-password')); ?>" class="text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
                    Login
                </button>

                <p class="text-sm text-center text-gray-600">
                    ¿No tienes una cuenta? 
                    <a href="<?php echo e(route('register')); ?>" class="text-blue-500 hover:underline">Regístrate</a>
                </p>
            </form>
        </div>
    </div>

    <script src="../PONER JS"></script>
</body>
</html>
<?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/login.blade.php ENDPATH**/ ?>