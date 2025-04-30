

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-semibold text-center text-blue-600 mb-8 flex items-center justify-center">
        Verificación del Estudiante: <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

        <i class="ml-2 fas fa-<?php echo e($verificationStatus); ?> text-5xl <?php echo e($verificationStatus == 'exclamation-circle' ? 'text-red-500' : ($verificationStatus == 'check-circle' ? 'text-yellow-500' : 'text-green-500')); ?>"></i>
    </h1>


    <!-- Sección de Datos del Estudiante -->
    <div class="bg-gray-100 p-6 rounded-lg mt-8 shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600 mb-4">Datos del Estudiante</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label class="font-semibold text-blue-500">Nombre:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->name ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->name ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Foto:</label>
                <div class="flex">
                    <span class="mr-1 <?php echo e($student->photoName ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->photoName ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <?php if($student->photoName): ?>
                        <img class="w-32 h-32 object-cover rounded-full" src="<?php echo e(asset('storage/photos/' . $student->photoName)); ?>" alt="<?php echo e($student->photoName); ?>">
                    <?php else: ?>
                        <span class="text-gray-500">No proporcionado</span>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Introducción:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->introduction ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->introduction ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($student->introduction ?? 'No proporcionada'); ?></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Especialización:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->specialization->specialization ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->specialization->specialization ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($student->specialization->specialization ?? 'No proporcionada'); ?></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Curso:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->curso ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->curso ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($student->curso ?? 'No proporcionado'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Datos del Proyecto -->
    <div class="bg-gray-100 p-6 rounded-lg mt-8 shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600 mb-4">Datos del Proyecto</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label class="font-semibold text-blue-500">Título del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->title ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->title ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($project->title ?? 'No proporcionado'); ?></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Especialización del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->specialization->specialization ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->specialization->specialization ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($project->specialization->specialization ?? 'No proporcionada'); ?></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Curso del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->curso ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->curso ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($project->curso ?? 'No proporcionado'); ?></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Resumen del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->abstract ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->abstract ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($project->abstract ?? 'No proporcionado'); ?></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Enlace a Moodle:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->moodleURL ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->moodleURL ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <?php if($project->moodleURL): ?>
                        <a href="<?php echo e($project->moodleURL); ?>" class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Acceder a Moodle</a>
                    <?php else: ?>
                        <span class="text-gray-500">No proporcionado</span>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">PDF del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->pdfURL ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->pdfURL ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <?php if($project->pdfURL): ?>
                        <a href="<?php echo e(asset('storage/pdfs/' . $project->pdfURL)); ?>"  class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Ver PDF</a>
                    <?php else: ?>
                        <span class="text-gray-500">No proporcionado</span>
                    <?php endif; ?>     
                   </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Foto del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->photoName ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->photoName ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <img class="h-32 object-cover" src="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>" alt="<?php echo e($project->photoName); ?>">
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Vídeo del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->videoURL ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->videoURL ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <?php if($project->videoURL): ?>
                        <!-- Mostrar el video en lugar de un enlace -->
                        <iframe class="h-32" src="<?php echo e($project->videoURL); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php else: ?>
                        <span class="text-gray-500">No proporcionado</span>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Ubicación del Proyecto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($project->ubication && $project->ubication->ubicationName ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($project->ubication && $project->ubication->ubicationName ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <p><?php echo e($project->ubication && $project->ubication->ubicationName ? $project->ubication->ubicationName : 'No proporcionada'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Datos del Currículum -->
    <div class="bg-gray-100 p-6 rounded-lg mt-8 shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600 mb-4">Datos del Currículum</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div>
                <label class="font-semibold text-blue-500">Lenguajes:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->languages->isNotEmpty() ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->languages->isNotEmpty() ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <ul>
                        <?php $__currentLoopData = $student->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($language->language); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Educación:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->educations->isNotEmpty() ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->educations->isNotEmpty() ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <ul>
                        <?php $__currentLoopData = $student->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($education->education); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Experiencia Laboral:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->workExperiences->isNotEmpty() ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->workExperiences->isNotEmpty() ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <ul>
                        <?php $__currentLoopData = $student->workExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workExperience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($workExperience->work_experience); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <div>
                <label class="font-semibold text-blue-500">Contacto:</label>
                <div class="flex items-center">
                    <span class="mr-1 <?php echo e($student->contacts->isNotEmpty() ? 'text-green-500' : 'text-red-500'); ?>">
                        <i class="fas fa-<?php echo e($student->contacts->isNotEmpty() ? 'check-circle' : 'exclamation-circle'); ?>"></i>
                    </span>
                    <ul>
                        <?php $__currentLoopData = $student->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($contact->contact); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón para verificar alumno -->
    <div class="mt-6 text-center">
        <form action="<?php echo e(route('professor.verify', $student->idStudent)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if($student->verification_status == 'verificado'): ?> 
                <button type="submit" class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-lg">
                    Eliminar Verificado
                </button>
            <?php else: ?>
                <button type="submit" class="text-white bg-green-600 hover:bg-green-700 py-2 px-4 rounded-lg">
                    Verificar Alumno
                </button>
            <?php endif; ?>
        </form>
    </div>
    <div class="mt-6 mb-6 text-center">
        <a href="javascript:history.back()" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">
            Volver Atrás
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/teachers/verifyStudent.blade.php ENDPATH**/ ?>