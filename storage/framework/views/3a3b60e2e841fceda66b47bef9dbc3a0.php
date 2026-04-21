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
            background-image: url('<?php echo e(public_path("images/Curriculum CV Fondo transparente.png")); ?>');
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
            width: 85px; 
            vertical-align: top;
        }
        .info-value {
            display: table-cell;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="watermark"></div>
    
    <div class="container">
        <div style="text-align: center; margin-bottom: 10px; padding-top: 20px;">
            <div class="avatar-container">
                <img src="<?php echo e($imageBase64); ?>" alt="<?php echo e($student->name); ?>"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <h1 style="font-size: 34px; font-weight: bold; color: #2563eb; margin: 12px 0 4px 0;">
                <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

            </h1>
        
            <div style="font-size: 18px; color: #1d4ed8; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                <?php echo e($student->specialization->specialization ?? 'GS Automoción'); ?>

            </div>
        </div>

        <div style="margin-top: 20px;">
            <div class="card">
                <h3>Datos de interés</h3>
                
                <div class="info-field">
                    <span class="info-label">Contacto:</span>
                    <span class="info-value">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php echo e($contact->contact); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$loop->last): ?>, <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <span style="color: #9ca3af; font-style: italic;">No especificado</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>

                <div class="info-field">
                    <span class="info-label">Localidad:</span>
                    <span class="info-value">
                        <?php echo e($student->city ?? 'No especificada'); ?> 
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($student->postal_code): ?> (<?php echo e($student->postal_code); ?>) <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($student->Linkedin): ?>
                    <div class="info-field">
                        <span class="info-label">LinkedIn:</span>
                        <span class="info-value" style="color: #2563eb;"><?php echo e($student->Linkedin); ?></span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="card">
                <h3>Sobre mí</h3>
                <p style="color: #374151; margin: 0; line-height: 1.5; text-align: left;">
                    <?php echo e($student->introduction ?? 'No especificada'); ?>

                </p>
            </div>

            <div class="card">
                <h3>Formación</h3>
                <ul class="cv-list">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li><?php echo e($education->education); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li>No especificada</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="card">
                <h3>Experiencia Laboral</h3>
                <ul class="cv-list">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->workExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li><?php echo e($experience->work_experience); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li>No especificada</li>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </ul>
            </div>

            <div class="card">
                <h3>Idiomas</h3>
                <div style="color: #374151;">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <p style="margin: 2px 0; line-height: 1.3;">• <?php echo e($language->language); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p style="margin: 0;">No especificado</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH /var/www/jornada-automocion-api/resources/views/students/showPDF.blade.php ENDPATH**/ ?>