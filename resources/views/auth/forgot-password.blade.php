<x-guest-layout>
    <div class="h-screen bg-cover bg-center relative flex items-center justify-center" style="background-image: url('/images/imagenFondo.webp')">
        <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

        <div class="relative z-10 w-full max-w-[420px] px-4">
            <div class="bg-white bg-opacity-95 p-6 md:p-8 rounded-[2.5rem] shadow-lg transition-all">
                
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logoMonlau2026(2).png') }}" alt="Logo" class="w-full max-w-[220px] h-auto object-contain">
                </div>
                
                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf
                    
                    <h2 class="text-xl font-bold text-center text-gray-800 uppercase tracking-tight">Recuperar Contraseña</h2>

                    <p class="text-xs text-center text-gray-500 leading-relaxed px-2">
                        Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                    </p>

                    @if ($errors->any())
                        <div class="text-[11px] text-red-600 bg-red-50 p-3 rounded-xl">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="text-[11px] text-green-600 bg-green-50 p-3 rounded-xl text-center font-bold">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="space-y-1">
                        <x-label for="email" value="{{ __('Email') }}" class="block text-xs font-semibold text-gray-600 ml-4 uppercase" />
                        <x-input 
                            id="email" 
                            class="block w-full px-5 py-3 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm bg-gray-50" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            placeholder="Introduce tu correo electrónico"
                        />
                    </div>

                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full bg-[#0051bb] hover:bg-[#004199] text-white font-bold py-3.5 rounded-full transition-all active:scale-[0.98] shadow-md uppercase text-[11px] tracking-widest">
                            Enviar enlace
                        </button>
                    </div>

                    <p class="text-[11px] text-center text-gray-500 pt-2">
                        ¿Recuerdas tu contraseña? 
                        <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">Iniciar sesión</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>