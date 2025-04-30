<x-guest-layout>
    <div class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
        <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

        <div class="flex items-center justify-center h-full relative z-10">
            <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md">
                <img src="{{ asset('images/logoMonlau.png') }}" alt="Logo" class="mx-auto w-40 mb-4">
                
                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf
                    
                    <h2 class="text-2xl font-bold text-center text-gray-800">Recuperar Contraseña</h2>

                    <p class="text-sm text-center text-gray-600">
                        Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                    </p>

                    <!-- Mensaje de error -->
                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Campo Email -->
                    <div class="space-y-2">
                        <x-label for="email" value="{{ __('Email') }}" class="block text-sm font-medium text-gray-600" />
                        <x-input 
                            id="email" 
                            class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            placeholder="Introduce tu correo electrónico"
                        />
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
                        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Iniciar sesión</a>
                    </p>
                </form>

                <!-- Mensaje de estado -->
                @if (session('status'))
                    <div class="mt-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
