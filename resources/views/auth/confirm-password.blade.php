<x-guest-layout>
    <div class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
        <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

        <div class="flex items-center justify-center h-full relative z-10">
            <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
                <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto w-40 mb-4">

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Esta es una área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
                </div>

                <!-- Formulario de confirmación de contraseña -->
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Contraseña') }}" class="block text-sm font-medium text-gray-600" />
                        <x-input id="password" class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" type="password" name="password" required autocomplete="current-password" autofocus placeholder="Introduce tu contraseña" />
                    </div>

                    <x-validation-errors class="mb-4" />

                    <div class="flex justify-end mt-4">
                        <x-button class="ms-4">
                            {{ __('Confirmar') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
