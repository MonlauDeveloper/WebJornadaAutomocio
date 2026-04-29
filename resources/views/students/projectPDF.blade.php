<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            background-color: #ffffff;
            margin: 0; padding: 0; color: #1f2937; line-height: 1.3;
        }
        .watermark {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('{{ public_path("images/Curriculum CV Fondo transparente.png") }}');
            background-size: cover; background-position: center; z-index: -1000;
        }
        .container { 
            width: 65%; 
            margin: 0 auto; 
            padding: 8px 0; 
        } 
        
        .text-blue { color: #2563eb; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; letter-spacing: 1px; }
        
        .card {
            margin: 0;
            padding: 1px 0;
            margin-bottom: 2px;
            page-break-inside: avoid;
        }
        
        .header-project { text-align: center; margin-bottom: 8px; } 
        .header-project h1 { 
            display: inline-block;
            padding: 4px 16px; font-size: 1.2rem; color: #1e40af; 
        }
        
        .section-title {
            font-size: 0.85rem; font-weight: bold; color: #1d4ed8;
            margin-top: 6px; margin-bottom: 4px; border-bottom: 1px solid #d5d6da; display: block;
        }
        
        .step-header {
            font-weight: bold; color: #1e40af; font-size: 0.75rem;
            border-bottom: 1px solid #c7d2fe; margin-bottom: 2px;
        }
        
        .img-header-box {
            width: 100%;
            height: 160px; 
            border-radius: 6px;
            overflow: hidden;
            text-align: center;
        }

        .img-header-box img {
            max-height: 100%;
            max-width: 100%;
            height: 160px;
            width: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .img-box {
            width: 100%;
            height: 140px; 
            border-radius: 6px;
            border: 1px solid #f3f4f6;
            background-color: #ffffff;
            overflow: hidden;
            text-align: center;
        }
        
        .img-box img {
            max-height: 100%;
            max-width: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        
        .desc-tecnica, .card p {
            font-size: 0.75rem;
            color: #4b5563;
            text-align: left;
            word-wrap: break-word; 
            overflow-wrap: break-word; 
            display: block;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .badge-tipo {
            background-color: #f3f4f6;
            color: #1e40af;
            padding: 1px 6px;
            border-radius: 4px;
            font-size: 0.65rem;
            margin-right: 4px;
            border: 0.5px solid #d1d5db;
            display: inline-block;
            vertical-align: middle;
            margin-top: 10px;
        }

        .indent-content { padding-left: 12px; }

        .conclusion-box {
            padding: 8px;
            margin-top: 4px;
            background-color: rgba(243, 244, 246, 0.3);
            border-radius: 6px;
        }

        table {
            table-layout: fixed; 
            width: 100%;
            border-collapse: collapse;
        }
        .info-field { 
            display: table; 
            width: 100%; 
            margin-bottom: 6px; 
            color: #4b5563; 
        }
        .info-label {
            font-weight: bold;
            color: #374151;
            display: table-cell; 
            width: 115px; 
            vertical-align: middle; 
            font-size: 0.78rem;
        }
        .info-value {
            display: table-cell;
            vertical-align: middle; 
            font-size: 0.78rem;
            color: #374151;
            line-height: 1.5;
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
                    <td width="70%" style="vertical-align: top;">
                        <h3 class="section-title uppercase">Datos del Proyecto</h3>
                        
                        <div class="info-field">
                            <span class="info-label">Equipo:</span>
                            <span class="info-value">
                                @foreach($students as $student)
                                    {{ $student->name }} {{ $student->surname1 }}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        </div>

                        <div class="info-field">
                            <span class="info-label">Especialidad:</span>
                            <span class="info-value text-blue">
                                {{ $project->specialization->specialization }}
                            </span>
                        </div>
                        
                        <div class="info-field">
                            <span class="info-label">Tipo de proyecto:</span>
                            <span class="info-value ">
                                @forelse($project->projectTypes as $tipo)
                                    <span class="badge-tipo">{{ $tipo->name }}</span>
                                @empty
                                    <span class="text-blue">No definido</span>
                                @endforelse
                            </span>
                        </div>
                    </td>
                    
                    @php $imgHeader = $project->images->where('fase', 'header')->first(); @endphp
                    @if($imgHeader)
                    <td width="30%" align="right" style="vertical-align: top;">
                        <div class="img-header-box">
                            <img src="{{ public_path('storage/project_steps/' . $imgHeader->file_path) }}" alt="Portada">
                        </div>
                    </td>
                    @endif
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Descripción</h3>
            <p>{{ $project->abstract }}</p>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Inicial</h3>
            <table width="100%">
                <tr>
                    @php $imgInitial = $project->images->where('fase', 'initial')->first(); @endphp
                    <td width="35%">
                        @if($imgInitial)
                            <div class="img-box">
                                <img src="{{ public_path('storage/project_steps/' . $imgInitial->file_path) }}" alt="Estado Inicial">
                            </div>
                        @else
                            <div style="width: 100%; height: 100px; background: #f3f4f6; text-align: center; line-height: 100px; color: #999; font-size: 0.6rem; border-radius: 6px;">SIN FOTO</div>
                        @endif
                    </td>
                    <td width="65%" style="padding-left: 15px; vertical-align: top;">
                        <p>{{ $imgInitial->description ?? 'Descripción del estado previo.' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Procedimiento Técnico</h3>
            @php 
                $pasos = $project->images->where('fase', 'procedimiento')->sortBy('orden')->take(3)->values(); 
            @endphp
            
            @forelse($pasos as $index => $img)
                <table style="width: 100%; margin-bottom: 4px;"> <tr>
                        @if($index % 2 == 0)
                            <td width="42%" style="vertical-align: top;">
                                <div class="step-header">PASO {{ $img->orden ?? ($index + 1) }}</div>
                                <div class="img-box">
                                    <img src="{{ public_path('storage/project_steps/' . $img->file_path) }}" alt="Paso">
                                </div>
                            </td>
                            <td width="58%" style="vertical-align: middle; padding-left: 15px;">
                                <div class="desc-tecnica" style="line-height: 1.2;">
                                    {{ $img->description }}
                                </div>
                            </td>
                        @else
                            <td width="58%" style="vertical-align: middle; padding-right: 15px;">
                                <div class="desc-tecnica" style="text-align: left; line-height: 1.2;">
                                    {{ $img->description }}
                                </div>
                            </td>
                            <td width="42%" style="vertical-align: top;">
                                <div class="step-header" style="text-align: right;">PASO {{ $img->orden ?? ($index + 1) }}</div>
                                <div class="img-box">
                                    <img src="{{ public_path('storage/project_steps/' . $img->file_path) }}" alt="Paso">
                                </div>
                            </td>
                        @endif
                    </tr>
                </table>
            @empty
                <p style="font-size: 0.7rem; color: #666;">No se han cargado pasos técnicos.</p>
            @endforelse
        </div>

        <div class="card">
            <h3 class="section-title uppercase" style="margin-top: 50px;">Estado Final</h3>
            @php $imgFinal = $project->images->where('fase', 'final')->first(); @endphp
            <table width="100%">
                <tr>
                    <td width="35%">
                        @if($imgFinal)
                            <div class="img-box">
                                <img src="{{ public_path('storage/project_steps/' . $imgFinal->file_path) }}" alt="Estado Final">
                            </div>
                        @endif
                    </td>
                    <td width="65%" style="padding-left: 15px; vertical-align: top;">
                        <p>{{ $imgFinal->description ?? 'Descripción del resultado final.' }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Conclusión Final</h3>
            <div class="conclusion-box">
                <p>{{ $project->conclusion ?? 'No se ha redactado una conclusión.' }}</p>
            </div>
        </div>
    </div>
</body>
</html>