<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(255, 255, 255);
            margin: 0;
            padding: 0;
        }

        .text-center {
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 24px;
        }

        .bg-white {
            background-color: #f9fafb;
        }

        .p-6 {
            padding: 24px;
        }

        .rounded-lg {
            border-radius: 12px;
        }

        .shadow-lg {
            box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1), 0px 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .w-32 {
            width: 100px;
        }

        .h-32 {
            height: 100px;
        }

        .object-cover {
            object-fit: cover;
        }

        .rounded-full {
            border-radius: 50%;
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
            margin-bottom: 24px;
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
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <img class="w-32 h-32 object-cover rounded-full mx-auto" 
                    src="<?php echo e(public_path('storage/photos/' . $student->photoName)); ?>" 
                    alt="<?php echo e($student->name); ?>">

            <h1 class="text-4xl font-bold text-blue-600 mt-4"><?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?></h1>

            <p class="text-gray-600 mt-2">
                <strong>Especialización:</strong> <?php echo e($student->specialization->specialization ?? 'No especificada'); ?>

            </p>

            <p class="text-gray-600 mt-2">
                <strong>Equipo:</strong> <?php echo e($student->team->teamName ?? 'Sin equipo asignado'); ?>

            </p>
        </div>

        <!-- Currículum -->
        <div class="mt-8">

            <!-- Introducción (ocupa toda la línea) -->
            <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold text-blue-600">Introducción</h3>
                <p class="text-gray-700"><?php echo e($student->introduction ?? 'No especificada'); ?></p>
            </div>

            <!-- Educación y Experiencia en dos columnas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Educación -->
                <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-600">Educación</h3>
                        <?php $__empty_1 = true; $__currentLoopData = $student->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <p class="text-gray-700"><?php echo e($education->education); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-gray-700">No especificada</p>
                        <?php endif; ?>
                </div>

                <!-- Experiencia Laboral -->
                <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-600">Experiencia Laboral</h3>
                        <?php $__empty_1 = true; $__currentLoopData = $student->workExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <p class="text-gray-700"><?php echo e($experience->work_experience); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-gray-700">No especificada</p>
                        <?php endif; ?>
                </div>

            </div>

            <!-- Idiomas y Contacto en dos columnas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

                <!-- Idiomas -->
                <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-600">Idiomas</h3>
                        <?php $__empty_1 = true; $__currentLoopData = $student->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <p class="text-gray-700"><?php echo e($language->language); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-gray-700">No especificado</p>
                        <?php endif; ?>
                </div>

                <!-- Contacto -->
                <div class="mb-6 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold text-blue-600">Contacto</h3>
                        <?php $__empty_1 = true; $__currentLoopData = $student->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <p class="text-gray-700"><?php echo e($contact->contact); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-gray-700">No especificado</p>
                        <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
<?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/students/showPDF.blade.php ENDPATH**/ ?>