<x-guest-layout>
    <div class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
        <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

        <div class="flex items-center justify-center h-full relative z-10">
            <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
                <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto w-40 mb-4">

                <!-- Formulario de restablecimiento de contraseña -->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <div class="block">
                        <x-label for="email" value="{{ __('Correo electrónico') }}" class="block text-sm font-medium text-gray-600" />
                        <x-input id="email" class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" type="email" name="email" :value="old('email', request()->email)" required autofocus autocomplete="username" placeholder="Introduce tu correo electrónico" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Contraseña') }}" class="block text-sm font-medium text-gray-600" />
                        <x-input id="password" class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" type="password" name="password" required autocomplete="new-password" placeholder="Introduce tu nueva contraseña" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" class="block text-sm font-medium text-gray-600" />
                        <x-input id="password_confirmation" class="block mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirma tu nueva contraseña" />
                    </div>

                    <x-validation-errors class="mb-4" />

                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Restablecer Contraseña') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
