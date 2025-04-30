@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Mi Perfil</h1>

        <!-- Foto y Nombre -->
        <div class="text-center mt-6">
            <h2 class="text-2xl font-semibold text-gray-800 mt-4">
                {{ $user->username }}
            </h2>
        </div>

        <!-- Configuración contraseña -->
        <div class="mt-8">
            <h2 class="text-3xl font-semibold text-blue-600">Configura tu Contraseña</h2>
            <form action="{{ route('updatePassword') }}" method="POST" class="space-y-6 mt-4">
                @csrf

                <!-- Mostrar mensajes de éxito o error -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Contraseña actual -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-600">Contraseña Actual</label>
                    <input type="password" name="current_password" id="current_password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           required>
                </div>

                <!-- Nueva Contraseña -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-600">Nueva Contraseña</label>
                    <input type="password" name="new_password" id="new_password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           required>
                </div>

                <!-- Confirmar Nueva Contraseña -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-600">Confirmar Nueva Contraseña</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           required>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                    Cambiar Contraseña
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
