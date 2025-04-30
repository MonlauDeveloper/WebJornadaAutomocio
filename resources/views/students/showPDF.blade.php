<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        @page {
            margin: 0; /* Elimina los márgenes del PDF */
        }

        body {
            font-family: Arial, sans-serif;
            background-color:rgb(255, 255, 255);
            margin: 0;
            padding: 0;
            position: relative;
        }

        .language-section {
            page-break-inside: avoid;
            page-break-before: auto; 
        }
   

        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ public_path("images/thumbnail_Fondo_1_CV.png") }}');
            background-size: cover; /* Asegura que cubra toda la página */
            background-position: left top; /* Ajusta la alineación */
            background-repeat: no-repeat;
            opacity: 0.7; /* Ajusta la transparencia */
            z-index: 1000; /* Envía la imagen al fondo */
        }

        .text-center {
            text-align: center;
        }

        .container {
            width: 75%;
            margin: 0 auto;
            padding: 24px;
        }

        .bg-white {
            background-color: #f9fafb;
        }

        .p-6 {
            padding: 4px 24px;
        }

        .rounded-lg {
            border-radius: 12px;
        }

        .shadow-lg {
            box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1), 0px 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Nuevo estilo para el contenedor de la imagen */
        .avatar-container {
            width: 128px;
            height: 128px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            border-radius: 50%;
            background-color: #f9fafb;
        }

        .mx-auto {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .text-4xl {
            font-size: 2.25rem;
            font-weight: bold;
        }

        .font-bold {
            font-weight: bold;
        }

        .text-blue-600 {
            color: #2563eb;
        }

        .mt-4 {
            margin-top: 16px;
        }

        .text-gray-600 {
            color: #4b5563;
        }

        .mt-2 {
            margin-top: 8px;
        }

        .mt-8 {
            margin-top: 32px;
        }

        .mb-6 {
            margin-bottom: 12px;
        }

        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .gap-8 {
            gap: 32px;
        }
        
        .h-6 {
            height: 24px;
        }

        .w-6 {
            width: 24px;
        }

        .mr-2 {
            margin-right: 8px;
        }

        .text-gray-700 {
            color: #374151;
        }
    </style>
</head>

<body>
    <div class="watermark"></div>
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <div class="avatar-container">
            <!-- Eliminamos las clases de la imagen y dejamos que el contenedor haga el trabajo -->
            <img src="{{ $imageBase64 }}" 
                 alt="{{ $student->name }}"
                 style="width: auto; height: 100%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        </div>

            <h1 class="text-4xl font-bold text-blue-600 mt-4">{{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}</h1>

            <p class="text-gray-600 mt-2">
                <strong>Especialización:</strong> {{ $student->specialization->specialization ?? 'No especificada' }}
            </p>

            <p class="text-gray-600 mt-2">
                <strong>Equipo:</strong> {{ $student->team->teamName ?? 'Sin equipo asignado' }}
            </p>
        </div>

        <!-- Currículum -->
        <div class="mt-8">

            <!-- Introducción (ocupa toda la línea) -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold text-blue-600">Sobre mí</h3>
                <p class="text-gray-700">{{ $student->introduction ?? 'No especificada' }}</p>
            </div>

            <!-- Contacto -->
            <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600">Contacto</h3>
                    @forelse($student->contacts as $contact)
                        <p class="text-gray-700">{{ $contact->contact }}</p>
                    @empty
                        <p class="text-gray-700">No especificado</p>
                    @endforelse
            </div>

            <!-- Educación y Experiencia en dos columnas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Educación -->
                <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-600">Formación</h3>
                        @forelse($student->educations as $education)
                            <p class="text-gray-700">{{ $education->education }}</p>
                        @empty
                            <p class="text-gray-700">No especificada</p>
                        @endforelse
                </div>

                <!-- Experiencia Laboral -->
                <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-600">Experiencia Laboral</h3>
                        @forelse($student->workExperiences as $experience)
                            <p class="text-gray-700">{{ $experience->work_experience }}</p>
                        @empty
                            <p class="text-gray-700">No especificada</p>
                        @endforelse
                </div>

            </div>

            <!-- Idiomas -->
            <div class="mb-6 bg-white p-6 rounded-lg shadow-lg language-section">
                <h3 class="text-xl font-semibold text-blue-600">Idiomas</h3>
                    @forelse($student->languages as $language)
                        <p class="text-gray-700">{{ $language->language }}</p>
                    @empty
                        <p class="text-gray-700">No especificado</p>
                    @endforelse
            </div>

                

        </div>
    </div>

</body>

</html>
