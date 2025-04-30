

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(public_path('build/assets/app-Cvpg7NpT.css')); ?>">
<div class="container mx-auto p-6">
    <!-- Información del Proyecto -->
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <h1 class="text-5xl font-bold text-blue-600"><?php echo e($project->title); ?></h1>
        <p class="text-gray-600 mt-4 text-lg"><strong>Categoría: </strong><?php echo e($project->specialization ? $project->specialization->specialization : ''); ?></p>
        <img class="w-3/4 object-cover rounded-lg mt-4 mx-auto" src="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>" alt="<?php echo e($project->title); ?>">

        <p class="text-gray-600 mt-4 text-lg"><?php echo e($project->abstract); ?></p>

        <div class="w-3/4 mt-6 mx-auto">
            <p class="font-semibold text-2xl text-blue-500">Vídeo:</p>
            <?php if($project->videoURL): ?>
                <!-- Mostrar el video en lugar de un enlace -->
                <video width="100%" controls>
                    <source src="<?php echo e(asset('storage/videos/' . $project->videoURL)); ?>" type="video/mp4">
                    Tu navegador no soporta el formato de video.
                </video>
            <?php else: ?>
                <span class="text-gray-500">No disponible</span>
            <?php endif; ?>
        </div>

        <div class="mt-6">
            <p class="font-semibold text-2xl text-blue-500">PDF:</p>
            <?php if($project->pdfURL): ?>
                <a href="<?php echo e(asset('storage/pdfs/' . $project->pdfURL)); ?>"  class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Ver PDF</a>
            <?php else: ?>
                <span class="text-gray-500">No disponible</span>
            <?php endif; ?>
        </div>

        <?php if(auth()->user()->idRole === 1 || auth()->user()->idRole === 4): ?>
        <div class="mt-6">
            <p class="font-semibold text-2xl text-blue-500">Moodle URL:</p>
            <?php if($project->moodleURL): ?>
                <a href="<?php echo e($project->moodleURL); ?>" class="inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition">Acceder a Moodle</a>
            <?php else: ?>
                <span class="text-gray-500">No disponible</span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Estudiantes Involucrados -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold text-blue-600">Estudiantes Involucrados</h2>

        <?php if($project->students->isNotEmpty()): ?>
            <ul class="mt-4 space-y-4">
                <?php $__currentLoopData = $project->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-center">
                        <a href="<?php echo e(route('students.show', $student->idStudent)); ?>" class="flex items-center hover:underline">
                            <img class="w-12 h-12 object-cover rounded-full mx-auto mr-4" 
                                src="<?php echo e(asset('storage/photos/' . $student->photoName)); ?>" 
                                alt="<?php echo e($student->name); ?>">
                            <div class="flex-1">
                                <p class="font-semibold text-lg text-gray-800"><?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?></p>
                        </a>
                            <?php if($student->isTeamLeader): ?>
                                <span class="text-sm text-green-600 font-medium">(Líder del Proyecto)</span>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500">No hay estudiantes asignados a este proyecto.</p>
        <?php endif; ?>
    </div>

    <div class="mt-6 text-center">
        <a href="<?php echo e(route('projects.index')); ?>" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">Volver al listado</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/projects/show.blade.php ENDPATH**/ ?>