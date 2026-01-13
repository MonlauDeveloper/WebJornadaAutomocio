@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Subir CSV</h1>

        <form action="{{ route('projects.subircsv') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            @csrf
            <div>
                <label for="csvFile" class="block text-lg font-semibold text-blue-500">Archivo CSV</label>
                <input type="file" name="csvFile" id="csvFile" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".csv" required>
                @error('csvFile')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">Subir CSV</button>
            </div>
        </form>
        <div class="text-center mt-6">
            <a href="{{ asset('storage/csv_uploads/Plantilla_Excel.csv') }}" download class="bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 transition">
                Descargar Plantilla
            </a>
        </div>
    </div>
</div>
@endsection
