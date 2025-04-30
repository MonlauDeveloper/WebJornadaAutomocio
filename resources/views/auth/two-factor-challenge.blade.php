<x-guest-layout>
    <div class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
        <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

        <div class="flex items-center justify-center h-full relative z-10">
            <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
                <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto w-40 mb-4">
                
                <div x-data="{ recovery: false }">
                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <!-- Mensaje de introducción -->
                        <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                            {{ __('Por favor, confirma el acceso a tu cuenta ingresando el código de autenticación proporcionado por tu aplicación de autenticación.') }}
                        </div>

                        <div class="mb-4 text-sm text-gray-600" x-cloak x-show="recovery">
                            {{ __('Por favor, confirma el acceso a tu cuenta ingresando uno de tus códigos de recuperación de emergencia.') }}
                        </div>

                        <!-- Código de autenticación -->
                        <div class="mt-4" x-show="! recovery">
                            <x-label for="code" value="{{ __('Código') }}" class="block text-sm font-medium text-gray-600" />
                            <x-input id="code" class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" placeholder="Introduce el código de autenticación" />
                        </div>

                        <!-- Código de recuperación -->
                        <div class="mt-4" x-cloak x-show="recovery">
                            <x-label for="recovery_code" value="{{ __('Código de recuperación') }}" class="block text-sm font-medium text-gray-600" />
                            <x-input id="recovery_code" class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" placeholder="Introduce el código de recuperación" />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <!-- Enlace para cambiar entre código de autenticación y código de recuperación -->
                            <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                x-show="! recovery"
                                x-on:click="
                                    recovery = true;
                                    $nextTick(() => { $refs.recovery_code.focus() })
                                ">
                                {{ __('Usar un código de recuperación') }}
                            </button>

                            <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                x-cloak
                                x-show="recovery"
                                x-on:click="
                                    recovery = false;
                                    $nextTick(() => { $refs.code.focus() })
                                ">
                                {{ __('Usar un código de autenticación') }}
                            </button>

                            <x-validation-errors class="mb-4" />

                            <!-- Botón de inicio de sesión -->
                            <x-button class="ms-4">
                                {{ __('Iniciar sesión') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
