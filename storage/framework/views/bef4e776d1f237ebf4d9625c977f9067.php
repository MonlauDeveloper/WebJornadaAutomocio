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
            background-image: url('<?php echo e(public_path("images/Curriculum CV Fondo transparente.png")); ?>');
            background-size: cover; background-position: center;
        }

        .container { width: 75%; margin: 0 auto; padding: 40px 0; }
        .text-blue { color: #2563eb; }
        .font-bold { font-weight: bold; }
        .uppercase { text-transform: uppercase; letter-spacing: 1px; }

        .card {
            margin-left: 13px; 
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

        .budget-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 0.85rem;
        }
        .budget-table th {
            background-color: #1e40af;
            color: white;
            padding: 8px;
            text-align: left;
            text-transform: uppercase;
        }
        .budget-table td {
            padding: 8px;
            border-bottom: 1px solid #d5d6da;
        }
        .budget-table .total-row {
            background-color: rgba(37, 99, 235, 0.1);
            font-weight: bold;
        }
        .text-right { text-align: right; }
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
                    <td width="65%" style="vertical-align: top;">
                        <h3 class="section-title uppercase">Datos del Proyecto</h3>
                        <p class="font-bold" style="font-size: 0.9rem;">Integrantes:</p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $students->chunk(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="width: 100%;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span style="font-size: 0.85rem; display: inline-block; width: 45%;">
                                        <span class="text-blue">•</span> <?php echo e($student->name); ?> <?php echo e($student->surname1); ?>

                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <p style="margin-top: 10px; font-size: 0.9rem;">
                            <strong>Especialidad:</strong> <span class="text-blue"><?php echo e($project->specialization->specialization); ?></span>
                        </p>
                    </td>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fotoHeader): ?>
                    <td width="35%" align="right">
                        <img src="<?php echo e($fotoHeader); ?>" style="width: 160px; border-radius: 10px; border: 3px solid white;">
                    </td>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Descripción</h3>
            <p style="font-size: 0.85rem; text-align: justify;"><?php echo e($project->abstract); ?></p>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Inicial</h3>
            <table width="100%">
                <tr>
                    <td width="40%">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fotoInitial): ?>
                            <img src="<?php echo e($fotoInitial); ?>" class="img-fase">
                        <?php else: ?>
                            <div style="width: 100%; height: 100px; background: #f3f4f6; text-align: center; line-height: 100px; color: #999;">SIN FOTO</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td width="60%" style="padding-left: 15px; vertical-align: top;">
                        <p style="font-size: 0.85rem;"><?php echo e($project->initial_description ?? 'Descripción del estado previo.'); ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Procedimiento Técnico</h3>
            <div style="width: 100%;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $fotosProcedimiento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="step-box" style="<?php echo e($index % 2 == 0 ? 'margin-right: 2%;' : ''); ?>">
                        <div class="step-header">PASO <?php echo e($index + 1); ?></div>
                        <img src="<?php echo e($foto); ?>" class="img-fase">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p style="font-size: 0.8rem; color: #666;">No se han cargado pasos técnicos.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="card">
            <h3 class="section-title uppercase">Estado Final</h3>
            <div style="text-align: center;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($fotoFinal): ?>
                    <img src="<?php echo e($fotoFinal); ?>" style="width: 80%; max-height: 200px; border-radius: 8px;">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <div class="card">
            <h3 class="section-title uppercase">Presupuesto</h3>
            <div style="text-align: center;">
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/jornada-automocion-api/resources/views/students/projectPDF.blade.php ENDPATH**/ ?>