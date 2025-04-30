<x-guest-layout>
    <div class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
        <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

        <div class="flex items-center justify-center h-full relative z-10">
            <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
                <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto w-40 mb-4">

                <!-- Mensaje de verificación centrado -->
                <div class="mb-4 text-sm text-gray-600 text-center">
                    {{ __('Antes de continuar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no has recibido el correo, con gusto te enviaremos otro.') }}
                </div>

                <!-- Mensaje de estado si se envió el enlace, centrado -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 text-center">
                        {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste en la configuración de tu perfil.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-center space-x-4">
                    <!-- Botón para reenviar el correo de verificación centrado -->
                    <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                        @csrf
                        <x-button type="submit" class="w-full">
                            {{ __('Reenviar correo de verificación') }}
                        </x-button>
                    </form>
                </div>

                <div class="mt-4 flex items-center justify-center space-x-4">
                    <!-- Enlace para editar perfil centrado -->
                    <a
                        href="{{ route('profile.show') }}"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        {{ __('Editar perfil') }}
                    </a>

                    <!-- Formulario para cerrar sesión, centrado -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf

                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">
                            {{ __('Cerrar sesión') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
