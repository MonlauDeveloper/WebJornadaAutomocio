<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css') 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favi2020.png') }}">

</head>
<body class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
    <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

    <div class="flex items-center justify-center h-full relative z-10">
        <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
            <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto w-40 mb-2">
                        
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <h2 class="text-2xl font-bold text-center text-gray-800">Iniciar sesión</h2>
                
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <x-input 
                        id="email" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        placeholder="Introduce tu email"
                        required 
                        autofocus 
                        autocomplete="username" />
                </div>

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
                            onclick="togglePassword()">
                            <i id="eyeIcon" class="fas fa-eye-slash"></i> 
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center space-x-2">
                        <x-checkbox id="remember_me" name="remember" class="text-blue-500 rounded" />
                        <span>Recordarme</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <x-validation-errors class="mb-4" />

                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
                    Login
                </button>

                <button 
                    type="button" 
                    onclick="window.location.href='{{ route('microsoft.login') }}'" 
                    class="w-full bg-white border border-gray-300 text-gray-800 font-semibold py-2 rounded-lg flex items-center justify-center space-x-2 transition hover:bg-gray-100">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" alt="Microsoft Logo" class="w-5 h-5">
                    <span>Iniciar sesión con Microsoft</span>
                </button>

                <p class="text-sm text-center text-gray-600">
                    ¿No tienes una cuenta? 
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Regístrate</a>
                    @endif
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
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
