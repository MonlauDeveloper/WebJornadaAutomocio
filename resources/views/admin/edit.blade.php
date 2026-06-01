@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Editar Empresa</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                {{ session('success') }}
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

        <form action="{{ route('admin.update', $user->idUser) }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
            @csrf
            @method('PUT')

            <div>
                <label for="username" class="block text-sm font-medium text-gray-600 font-bold text-blue-600">Usuario de acceso (Para Login sin @)</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                       class="w-full px-4 py-2 border border-blue-300 bg-blue-50/30 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none font-semibold" required>
                <small class="text-gray-400 text-xs block mt-1">Este es el alias corto que usará la empresa para entrar. El sistema quitará los espacios automáticamente al guardar.</small>
            </div>

            <div>
                <label for="companyName" class="block text-sm font-medium text-gray-600">Nombre de la Empresa</label>
                <input type="text" name="companyName" id="companyName" value="{{ old('companyName', $user->company->companyName) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label for="companyWeb" class="block text-sm font-medium text-gray-600">Página Web</label>
                <input type="url" name="companyWeb" id="companyWeb" value="{{ old('companyWeb', $user->company->companyWeb) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="asistenteNombre" class="block text-sm font-medium text-gray-600">Nombre del Asistente</label>
                    <input type="text" name="asistenteNombre" id="asistenteNombre" value="{{ old('asistenteNombre', $user->company->asistenteNombre) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="asistenteApellidos" class="block text-sm font-medium text-gray-600">Apellidos</label>
                    <input type="text" name="asistenteApellidos" id="asistenteApellidos" value="{{ old('asistenteApellidos', $user->company->asistenteApellidos) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="telefonoAsistente" class="block text-sm font-medium text-gray-600">Teléfono</label>
                    <input type="text" name="telefonoAsistente" id="telefonoAsistente" value="{{ old('telefonoAsistente', $user->company->telefonoAsistente) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="emailAsistente" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="emailAsistente" id="emailAsistente" value="{{ old('emailAsistente', $user->company->emailAsistente) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
            </div>

            <div>
                <label for="cargoAsistente" class="block text-sm font-medium text-gray-600">Cargo</label>
                <input type="text" name="cargoAsistente" id="cargoAsistente" value="{{ old('cargoAsistente', $user->company->cargoAsistente) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div>
                <label for="logo" class="block text-sm font-medium text-gray-600 mb-2">Logo de la Empresa</label>
                <input type="file" name="logo" id="logo" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                
                @if($user->company->logo_url)
                    <div class="mt-4">
                        <p class="text-xs text-gray-400 mb-2 text-center">Vista previa actual:</p>
                        <div class="w-full h-40 bg-gray-50 border border-gray-100 rounded-xl flex items-center justify-center p-4 overflow-hidden shadow-inner">
                            <img src="{{ asset('storage/photos/' . $user->company->logo_url) }}" 
                                 alt="{{ $user->username }}" 
                                 class="max-w-full max-h-full object-contain">
                        </div>
                    </div>
                @endif
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                Guardar Cambios
            </button>
        </form>
    </div>
</div>
@endsection