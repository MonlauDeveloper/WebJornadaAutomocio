@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Crear Nueva Empresa</h1>

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

        <form action="{{ route('admin.storeCompany') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
            @csrf

            <!-- Nombre de la Empresa -->
            <div>
                <label for="companyName" class="block text-sm font-medium text-gray-600">Nombre de la Empresa</label>
                <input type="text" name="companyName" id="companyName" value="{{ old('companyName') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <!-- Página Web -->
            <div>
                <label for="companyWeb" class="block text-sm font-medium text-gray-600">Página Web</label>
                <input type="url" name="companyWeb" id="companyWeb" value="{{ old('companyWeb') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Asistente -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="asistenteNombre" class="block text-sm font-medium text-gray-600">Nombre del Asistente</label>
                    <input type="text" name="asistenteNombre" id="asistenteNombre" value="{{ old('asistenteNombre') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="asistenteApellidos" class="block text-sm font-medium text-gray-600">Apellidos</label>
                    <input type="text" name="asistenteApellidos" id="asistenteApellidos" value="{{ old('asistenteApellidos') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
            </div>

            <!-- Contacto -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="telefonoAsistente" class="block text-sm font-medium text-gray-600">Teléfono</label>
                    <input type="text" name="telefonoAsistente" id="telefonoAsistente" value="{{ old('telefonoAsistente') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="emailAsistente" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="emailAsistente" id="emailAsistente" value="{{ old('emailAsistente') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
            </div>

            <!-- Cargo -->
            <div>
                <label for="cargoAsistente" class="block text-sm font-medium text-gray-600">Cargo</label>
                <input type="text" name="cargoAsistente" id="cargoAsistente" value="{{ old('cargoAsistente') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <!-- Logo -->
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-600">Logo de la Empresa</label>
                <input type="file" name="logo" id="logo" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                Crear Empresa
            </button>
        </form>
    </div>
</div>
@endsection
