<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #ffffff;
            margin: 0; padding: 0; color: #1f2937; line-height: 1.4;
        }

        /* Marca de agua muy visible */
        .watermark {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('{{ public_path("images/thumbnail_Fondo_1_CV.png") }}');
            background-size: cover; background-position: center; opacity: 0.8; z-index: -1000;
        }

        /* Logos laterales solo página 1 */
        .first-page-graphics {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -500;
        }

        /* Contenedor Estrecho (75%) */
        .container { width: 75%; margin: 0 auto; padding: 40px 0; }

        .text-blue { color: #2563eb; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; letter-spacing: 1px; }

        .card {
            margin-left: 19px; 
            background-color: rgba(255, 255, 255, 0.85);
            padding: 20px; border-radius: 12px; margin-bottom: 10px;
            border: 1px solid rgba(44, 85, 166, 0.6);
        }

        /* Título con doble línea como en tu dibujo */
        .header-project { text-align: center; margin-bottom: 25px; }
        .header-project h1 { 
            display: inline-block;
            padding: 10px 30px; font-size: 1.8rem; color: #1e40af;
        }

        .section-title {
            font-size: 1rem; font-weight: bold; color: #1d4ed8;
            margin-bottom: 8px; border-bottom: 2px solid #e5e7eb; display: block;
        }

        /* Rejilla de procedimiento (4 fotos) */
        .steps-grid { width: 100%; margin-top: 10px; }
        .step-item { 
            width: 23%; display: inline-block; vertical-align: top; 
            border: 1px solid #ccc; background: white; padding: 5px; text-align: center; font-size: 10px;
        }

        /* Tabla comparativa final */
        .stats-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; }
        .stats-table td { border: 1px solid #ddd; padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <div class="watermark"></div>
    <div class="first-page-graphics">
        
        </div>

    <div class="container">
        <div class="header-project">
            <h1 class="uppercase">{{ $project->title }}</h1>
        </div>

        <div class="card">
    <table width="100%" style="border-collapse: collapse;">
        <tr>
            <td width="65%" style="vertical-align: top; padding-right: 10px;">
                <h3 class="section-title uppercase">Datos del Proyecto</h3>
                
                <p class="font-bold" style="margin-bottom: 5px; font-size: 0.9rem;">Integrantes:</p>
                
                <div style="width: 100%;">
                    {{-- Dividimos la colección de estudiantes en 2 grupos --}}
                    @foreach($students->chunk(ceil($students->count() / 2)) as $chunk)
                        <div style="width: 48%; display: inline-block; vertical-align: top;">
                            <ul style="list-style: none; padding: 0; margin: 0; font-size: 0.85rem;">
                                @foreach($chunk as $student)
                                    <li style="margin-bottom: 3px; white-space: nowrap;">
                                        <span class="text-blue">•</span> {{ $student->name }} {{ $student->surname1 }}
                                        @if($student->pivot && $student->pivot->isTeamLeader) 
                                            <small class="text-blue" style="font-size: 0.7rem;">(Líder)</small> 
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>

                <p style="margin-top: 15px; font-size: 0.9rem;">
                    <strong>Especialidad:</strong> 
                    <span class="text-blue">{{ $project->specialization->specialization ?? 'Automoción' }}</span>
                </p>
            </td>

            <td width="35%" align="right" style="vertical-align: top;">
                @if($projectImageBase64)
                    <img src="{{ $projectImageBase64 }}" style="width: 100%; max-width: 160px; border-radius: 10px; border: 3px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                @endif
            </td>
        </tr>
    </table>
    </div>

        <div class="card">
            <h3 class="section-title uppercase">Descripción</h3>
            <p style="font-size: 0.9rem; text-align: justify;">{{ $project->abstract }}</p>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Inicial</h3>
            <p style="font-size: 0.9rem;">{{ $project->initial_state ?? 'Descripción del estado previo del proyecto.' }}</p>
        </div>
        <div class="card">
            <h3 class="section-title uppercase">Procedimiento</h3>
        </div>
        <div class="card" style="margin-top: 20px;">
            <h3 class="section-title uppercase">Estado Final</h3>

        </div>
    </div>
</body>
</html>