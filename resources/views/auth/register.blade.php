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

    <div class="flex items-center justify-center h-full relative z-10 px-4">
        <div class="bg-white bg-opacity-95 p-6 md:p-8 rounded-[2.5rem] shadow-lg w-full max-w-[420px] transition-all overflow-y-auto max-h-[95vh]">

            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logoMonlau2026(2).png') }}" alt="Logo"
                    class="w-full max-w-[200px] h-auto object-contain">
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <h2 class="text-xl font-bold text-center text-gray-800">Crear cuenta</h2>

                <div class="space-y-3">
                    <div class="space-y-1">
                        <label for="username" class="block text-xs font-semibold text-gray-600 ml-4 uppercase">Nombre de Usuario</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm"
                            placeholder="Introduce tu nombre de Usuario" required autofocus autocomplete="username">
                    </div>

                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-semibold text-gray-600 ml-4 uppercase">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm"
                            placeholder="Introduce tu correo electrónico" required autocomplete="username">
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="block text-xs font-semibold text-gray-600 ml-4 uppercase">Contraseña</label>
                        <div class="relative">
                            <x-input id="password"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm"
                                type="password" name="password" placeholder="Introduce tu contraseña" required
                                autocomplete="current-password" />
                            <span class="absolute inset-y-0 right-5 flex items-center text-gray-400 cursor-pointer hover:text-blue-500"
                                onclick="togglePassword('password', 'eyeIcon1')">
                                <i id="eyeIcon1" class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label for="password_confirmation" class="block text-xs font-semibold text-gray-600 ml-4 uppercase">Confirmar Contraseña</label>
                        <div class="relative">
                            <x-input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm"
                                placeholder="Repite tu contraseña" required autocomplete="new-password" />
                            <span class="absolute inset-y-0 right-5 flex items-center text-gray-400 cursor-pointer hover:text-blue-500"
                                onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                                <i id="eyeIcon2" class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="px-2">
                    <label for="terms" class="flex items-center">
                        <input type="checkbox" name="terms" id="terms" required class="rounded text-blue-500 scale-90">
                        <span class="text-[11px] text-gray-600 ml-2 leading-tight">
                            Acepto los <a href="{{ route('terms.show') }}" target="_blank" class="text-blue-500 hover:underline font-bold">Términos</a> y la <a href="{{ route('policy.show') }}" target="_blank" class="text-blue-500 hover:underline font-bold">Privacidad</a>.
                        </span>
                    </label>
                </div>
                @endif

                <x-validation-errors class="mb-1" />

                <div class="pt-1">
                    <button type="submit"
                        class="w-full bg-[#0051bb] hover:bg-[#004199] text-white font-bold py-3 rounded-full transition-all active:scale-[0.98] shadow-md uppercase text-[10px] tracking-widest">
                        Registrarse
                    </button>
                </div>

                <div class="space-y-1 pt-1">
                    <p class="text-[11px] text-center text-gray-500">
                        ¿Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Iniciar sesión</a>
                    </p>
                    <p class="text-[11px] text-center text-gray-500">
                        <a href="{{ route('register-empresa') }}" class="text-blue-600 font-bold hover:underline italic">Crear cuenta de empresa</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(passwordId, eyeIconId) {
            const passwordInput = document.getElementById(passwordId);
            const eyeIcon = document.getElementById(eyeIconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>

</html>