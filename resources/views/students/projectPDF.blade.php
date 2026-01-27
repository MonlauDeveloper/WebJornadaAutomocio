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

        .watermark {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('{{ public_path("images/thumbnail_Fondo_1_CV.png") }}');
            background-size: cover; background-position: center; opacity: 0.8; z-index: -1000;
        }

        .container { width: 75%; margin: 0 auto; padding: 60px 0; }
        .text-blue { color: #2563eb; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; letter-spacing: 1px; }

        .card {
            margin-left: 19px; 
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px; border-radius: 12px; margin-bottom: 20px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            page-break-inside: avoid;
        }

        .header-project { text-align: center; margin-bottom: 25px; }
        .header-project h1 { 
            display: inline-block;
            padding: 10px 30px; font-size: 1.6rem; color: #1e40af;
        }

        .section-title {
            font-size: 1rem; font-weight: bold; color: #1d4ed8;
            margin-bottom: 8px; border-bottom: 2px solid #d5d6da; display: block;
        }

        /* Diseño de pasos de procedimiento */
        .step-box {
            width: 48%;
            display: inline-block;
            vertical-align: top;
            margin-bottom: 15px;
        }
        .step-header {
            font-weight: bold; color: #1e40af; font-size: 0.8rem;
            border-bottom: 1px solid #1e40af; margin-bottom: 5px;
        }
        .img-fase {
            width: 100%; height: 100px; object-fit: cover;
            border-radius: 6px; border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="watermark"></div>

    <div class="container">
        <div class="header-project">
            <h1 class="uppercase">{{ $project->title }}</h1>
        </div>

        <div class="card">
            <table width="100%">
                <tr>
                    <td width="65%" style="vertical-align: top;">
                        <h3 class="section-title uppercase">Datos del Proyecto</h3>
                        <p class="font-bold" style="font-size: 0.9rem;">Integrantes:</p>
                        @foreach($students->chunk(2) as $chunk)
                            <div style="width: 100%;">
                                @foreach($chunk as $student)
                                    <span style="font-size: 0.85rem; display: inline-block; width: 45%;">
                                        <span class="text-blue">•</span> {{ $student->name }} {{ $student->surname1 }}
                                    </span>
                                @endforeach
                            </div>
                        @endforeach
                        <p style="margin-top: 10px; font-size: 0.9rem;">
                            <strong>Especialidad:</strong> <span class="text-blue">{{ $project->specialization->specialization }}</span>
                        </p>
                    </td>
                    <td width="35%" align="right">
                        @if($fotoHeader)
                            <img src="{{ $fotoHeader }}" style="width: 160px; border-radius: 10px; border: 3px solid white;">
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Descripción</h3>
            <p style="font-size: 0.85rem; text-align: justify;">{{ $project->abstract }}</p>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Inicial</h3>
            <table width="100%">
                <tr>
                    <td width="40%">
                        @if($fotoInitial)
                            <img src="{{ $fotoInitial }}" class="img-fase">
                        @else
                            <div style="width: 100%; height: 100px; background: #f3f4f6; text-align: center; line-height: 100px; color: #999;">SIN FOTO</div>
                        @endif
                    </td>
                    <td width="60%" style="padding-left: 15px; vertical-align: top;">
                        <p style="font-size: 0.85rem;">{{ $project->initial_description ?? 'Descripción del estado previo.' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Procedimiento Técnico</h3>
            <div style="width: 100%;">
                @forelse($fotosProcedimiento as $index => $foto)
                    <div class="step-box" style="{{ $index % 2 == 0 ? 'margin-right: 2%;' : '' }}">
                        <div class="step-header">PASO {{ $index + 1 }}</div>
                        <img src="{{ $foto }}" class="img-fase">
                    </div>
                @empty
                    <p style="font-size: 0.8rem; color: #666;">No se han cargado pasos técnicos.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Final</h3>
            <div style="text-align: center;">
                @if($fotoFinal)
                    <img src="{{ $fotoFinal }}" style="width: 80%; max-height: 200px; border-radius: 8px;">
                @endif
            </div>
        </div>
    </div>
</body>
</html>