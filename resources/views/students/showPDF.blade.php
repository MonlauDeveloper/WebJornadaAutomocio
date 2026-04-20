<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        @page { margin: 0; }
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0; padding: 0;
            position: relative;
            color: #333;
            font-size: 15px; 
        }
        .watermark {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('{{ public_path("images/Curriculum CV Fondo transparente.png") }}');
            background-size: cover;
            background-position: left top;
            background-repeat: no-repeat;
            z-index: -1;
        }
        .container {
            width: 85%;
            margin: 0 auto;
            padding: 15px;
        }
        .card {
            margin-left: 13px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            margin-bottom: 8px; 
            padding: 12px 25px; 
        }
        .avatar-container {
            width: 130px; height: 130px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            border-radius: 50%;
            background-color: #f9fafb;
            border: 3px solid #f3f4f6;
        }
        h3 {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
            margin: 0 0 8px 0;
            padding-bottom: 3px;
        }
        .cv-list {
            padding-left: 22px;
            margin: 0;
            list-style-type: disc;
            color: #374151;
        }
        .cv-list li { margin-bottom: 2px; line-height: 1.4; }
        .info-field { margin-bottom: 4px; color: #4b5563; }
        .info-label {
            font-weight: bold;
            color: #374151;
            min-width: 100px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="watermark"></div>
    
    <div class="container">
        <div style="text-align: center; margin-bottom: 10px; padding-top: 20px;">
            <div class="avatar-container">
                <img src="{{ $imageBase64 }}" alt="{{ $student->name }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <h1 style="font-size: 34px; font-weight: bold; color: #2563eb; margin: 12px 0 4px 0;">
                {{ $student->name }} {{ $student->surname1 }} {{ $student->surname2 }}
            </h1>
        
            <div style="font-size: 18px; color: #1d4ed8; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                {{ $student->specialization->specialization ?? 'GS Automoción' }}
            </div>
        </div>

        <div style="margin-top: 20px;">
            <div class="card">
                <h3>Datos de interés</h3>
                
                <div class="info-field">
                    <span class="info-label">Contacto:</span>
                    <span style="color: #374151;">
                        @forelse($student->contacts as $contact)
                            {{ $contact->contact }}@if(!$loop->last), @endif
                        @empty
                            <span style="color: #9ca3af; font-style: italic;">No especificado</span>
                        @endforelse
                    </span>
                </div>

                <div class="info-field">
                    <span class="info-label">Localidad:</span>
                    <span>
                        {{ $student->city ?? 'No especificada' }} 
                        @if($student->postal_code) ({{ $student->postal_code }}) @endif
                    </span>
                </div>
                
                @if($student->Linkedin)
                    <div class="info-field">
                        <span class="info-label">LinkedIn:</span>
                        <span style="color: #2563eb; font-size: 14px;">{{ $student->Linkedin }}</span>
                    </div>
                @endif
            </div>

            <div class="card">
                <h3>Sobre mí</h3>
                <p style="color: #374151; margin: 0; line-height: 1.5; text-align: left;">
                    {{ $student->introduction ?? 'No especificada' }}
                </p>
            </div>

            <div class="card">
                <h3>Formación</h3>
                <ul class="cv-list">
                    @forelse($student->educations as $education)
                        <li>{{ $education->education }}</li>
                    @empty
                        <li>No especificada</li>
                    @endforelse
                </ul>
            </div>

            <div class="card">
                <h3>Experiencia Laboral</h3>
                <ul class="cv-list">
                    @forelse($student->workExperiences as $experience)
                        <li>{{ $experience->work_experience }}</li>
                    @empty
                        <li>No especificada</li>
                    @endforelse
                </ul>
            </div>

            <div class="card">
                <h3>Idiomas</h3>
                <div style="color: #374151;">
                    @forelse($student->languages as $language)
                        <p style="margin: 2px 0; line-height: 1.3;">• {{ $language->language }}</p>
                    @empty
                        <p style="margin: 0;">No especificado</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</body>
</html>