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
            background-image: url('<?php echo e(public_path("images/Curriculum CV Fondo transparente.png")); ?>');
            background-size: cover; background-position: center; z-index: -1000;
        }
        .container { 
            width: 75%; 
            margin: 0 auto; 
            padding: 10px 0; 
        } 
        
        .text-blue { color: #2563eb; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; letter-spacing: 1px; }
        
        .card {
            margin-left: 23px; 
            padding: 5px 2px; 
            margin-bottom: 8px; 
            page-break-inside: avoid;
        }
        
        .header-project { text-align: center; margin-bottom: 12px; } 
        .header-project h1 { 
            display: inline-block;
            padding: 5px 20px; font-size: 1.4rem; color: #1e40af; 
        }
        
        .section-title {
            font-size: 0.85rem; font-weight: bold; color: #1d4ed8;
            margin-bottom: 5px; border-bottom: 2px solid #d5d6da; display: block;
        }
        
        .step-header {
            font-weight: bold; color: #1e40af; font-size: 0.75rem;
            border-bottom: 1px solid #1e40af; margin-bottom: 3px;
        }
        
        .img-fase {
            width: 100%; 
            border-radius: 6px; border: 1px solid #ddd;
            background-color: #fff;
            background-size: cover;
            background-position: center;
        }
        
        .desc-tecnica, .card p {
            font-size: 0.78rem;
            color: #4b5563;
            text-align: justify;
            word-wrap: break-word; 
            overflow-wrap: break-word; 
            word-break: break-all;
            display: block;
            width: 100%;
        }

        .badge-tipo {
            background-color: #f3f4f6;
            color: #1e40af;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            margin-right: 5px;
            border: 0.5px solid #d1d5db;
            display: inline-block;
            vertical-align: middle;
        }

        .indent-content {
            padding-left: 15px;
        }

        .conclusion-box {
            padding: 10px;
            margin-top: 5px;
        }
        table {
            table-layout: fixed; 
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="watermark"></div>

    <div class="container">
        <div class="header-project">
            <h1 class="uppercase"><?php echo e($project->title); ?></h1>
        </div>

        <div class="card">
            <table width="100%">
                <tr>
                    <td width="70%" style="vertical-align: top;">
                        <h3 class="section-title uppercase">Datos del Proyecto</h3>
                        
                        <p class="font-bold" style="font-size: 0.82rem; margin-bottom: 4px;">Equipo del proyecto:</p>
                        <div class="indent-content"> 
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $students->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div style="width: 100%; margin-bottom: 2px;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span style="font-size: 0.78rem; display: inline-block; width: 48%;">
                                            <span class="text-blue">•</span> <?php echo e($student->name); ?> <?php echo e($student->surname1); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <p style="margin-top: 6px; font-size: 0.82rem;">
                            <strong>Especialidad:</strong> 
                            <span class="text-blue" style="vertical-align: middle;"><?php echo e($project->specialization->specialization); ?></span>
                        </p>
                        
                        <div style="margin-top: 2px; font-size: 0.82rem;">
                            <p><strong style="vertical-align: middle;">Tipo de proyecto:</strong> 
                            <span class="indent-content" style=" padding-left: 5px;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $project->projectTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <span class="badge-tipo"><?php echo e($tipo->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <span class="text-blue">No definido</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span></p>
                        </div>
                    </td>
                    
                    <?php $imgHeader = $project->images->where('fase', 'header')->first(); ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imgHeader): ?>
                    <td width="30%" align="right" style="vertical-align: top;">
                        <div style="width: 190px; height: 120px; background-image: url('<?php echo e(public_path('storage/project_steps/' . $imgHeader->file_path)); ?>'); background-size: cover; background-position: center; border-radius: 8px; border: 2px solid white;"></div>
                    </td>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Descripción</h3>
            <p style="margin: 0;"><?php echo e($project->abstract); ?></p>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Inicial</h3>
            <table width="100%">
                <tr>
                    <?php $imgInitial = $project->images->where('fase', 'initial')->first(); ?>
                    <td width="30%">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imgInitial): ?>
                            <div class="img-fase" style="height: 85px; background-image: url('<?php echo e(public_path('storage/project_steps/' . $imgInitial->file_path)); ?>');"></div>
                        <?php else: ?>
                            <div style="width: 100%; height: 85px; background: #f3f4f6; text-align: center; line-height: 85px; color: #999; font-size: 0.6rem; border-radius: 6px;">SIN FOTO</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td width="70%" style="padding-left: 15px; vertical-align: top;">
                        <p style="margin: 0;"><?php echo e($imgInitial->description ?? 'Descripción del estado previo.'); ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Procedimiento Técnico</h3>
            <?php 
                $pasos = $project->images->where('fase', 'procedimiento')->sortBy('orden')->take(3)->values(); 
            ?>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pasos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <table style="width: 100%; margin-bottom: 8px; table-layout: fixed; border-collapse: collapse;">
                    <tr>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index % 2 == 0): ?>
                            <td width="35%" style="vertical-align: top;">
                                <div class="step-header">PASO <?php echo e($img->orden ?? ($index + 1)); ?></div>
                                <div class="img-fase" style="height: 90px; background-image: url('<?php echo e(public_path('storage/project_steps/' . $img->file_path)); ?>');"></div>
                            </td>
                            <td width="65%" style="vertical-align: middle; padding-left: 15px; word-break: break-all;">
    <div class="desc-tecnica"><?php echo e($img->description); ?></div>
</td>
                        <?php else: ?>
                            <td width="65%" style="vertical-align: middle; padding-right: 15px;">
                                <div class="desc-tecnica" style="text-align: justify;"><?php echo e($img->description); ?></div>
                            </td>
                            <td width="35%" style="vertical-align: top;">
                                <div class="step-header" style="text-align: right;">PASO <?php echo e($img->orden ?? ($index + 1)); ?></div>
                                <div class="img-fase" style="height: 90px; background-image: url('<?php echo e(public_path('storage/project_steps/' . $img->file_path)); ?>');"></div>
                            </td>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </tr>
                </table>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="font-size: 0.7rem; color: #666;">No se han cargado pasos técnicos.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Final</h3>
            <?php $imgFinal = $project->images->where('fase', 'final')->first(); ?>
            <table width="100%">
                <tr>
                    <td width="30%">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($imgFinal): ?>
                            <div class="img-fase" style="height: 85px; background-image: url('<?php echo e(public_path('storage/project_steps/' . $imgFinal->file_path)); ?>');"></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td width="70%" style="padding-left: 15px; vertical-align: top;">
                        <p style="margin: 0;"><?php echo e($imgFinal->description ?? 'Descripción del resultado final.'); ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Conclusión Final</h3>
            <div class="conclusion-box">
                <p style="margin: 0;"><?php echo e($project->conclusion ?? 'No se ha redactado una conclusión para este proyecto.'); ?></p>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/jornada-automocion-api/resources/views/students/projectPDF.blade.php ENDPATH**/ ?>