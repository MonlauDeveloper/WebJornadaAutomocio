<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    @vite('resources/css/app.css') 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favi2020.png') }}">

</head>
<body class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
    <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

    <div class="flex items-center justify-center h-full relative z-10">
        <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
            <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto w-40 mb-2">
                        
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                
                <h2 class="text-2xl font-bold text-center text-gray-800">Crear cuenta</h2>
                
                <!-- Campo Usuario -->
                <div class="space-y-2">
                    <label for="username" class="block text-sm font-medium text-gray-600">Nombre de Usuario</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Introduce tu nombre de Usuario"
                        required autofocus autocomplete="username">
                </div>

                <!-- Campo Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Introduce tu correo electrónico"
                        required autocomplete="username">
                </div>

                <!-- Campo Contraseña -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-600">Contraseña</label>
                    <div class="relative">
                        <x-input 
                            id="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                            type="password" 
                            name="password" 
                            placeholder="Introduce tu contraseña"
                            required 
                            autocomplete="current-password" />
                        <span 
                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer"
                            onclick="togglePassword('password', 'eyeIcon1')">
                            <i id="eyeIcon1" class="fas fa-eye-slash"></i> 
                        </span>
                    </div>
                </div>

                <!-- Campo Verificar Contraseña -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirmar Contraseña</label>
                    <div class="relative">
                        <x-input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                            placeholder="Repite tu contraseña"
                            required autocomplete="new-password">
                        </x-input>
                        <span 
                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer"
                            onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                            <i id="eyeIcon2" class="fas fa-eye-slash"></i> 
                        </span>
                    </div>
                </div>

                <!-- Términos y condiciones -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="space-y-2">
                    <label for="terms" class="flex items-center">
                        <input type="checkbox" name="terms" id="terms" required class="mr-2">
                        <span class="text-sm text-gray-600">
                            Acepto los 
                            <a href="{{ route('terms.show') }}" target="_blank" class="text-blue-500 hover:underline">Términos de Servicio</a> y la 
                            <a href="{{ route('policy.show') }}" target="_blank" class="text-blue-500 hover:underline">Política de Privacidad</a>.
                        </span>
                    </label>
                </div>
                @endif

                <x-validation-errors class="mb-4" />

                <!-- Botón de Registro -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
                    Registrarse
                </button>

                <!-- Enlace a Login -->
                <p class="text-sm text-center text-gray-600">
                    ¿Ya tienes una cuenta? 
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Iniciar sesión</a>
                </p>
                <p class="text-sm text-center text-gray-600">
                    <a href="{{ route('register-empresa') }}" class="text-blue-500 hover:underline">Crear cuenta de empresa</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(passwordId, eyeIconId) {
            const passwordInput = document.getElementById(passwordId);
            const eyeIcon = document.getElementById(eyeIconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>
