<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <img class="w-32 h-32 object-cover rounded-full mx-auto" 
                 src="<?php echo e(asset('storage/photos/' . $student->photoName)); ?>" 
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
            <h3 class="text-xl font-semibold text-blue-600 mb-4">Introducción</h3>
            <p class="text-gray-700"><?php echo e($student->introduction ?? 'No especificada'); ?></p>
        </div>

        <!-- Educación y Experiencia en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Educación -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Educación</h3>
                <div>
                    <?php $__currentLoopData = explode(';', $student->education); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(trim($education) !== ''): ?>
                            <div class="mb-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                <p class="text-gray-700"><?php echo e($education); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Experiencia Laboral -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Experiencia Laboral</h3>
                <div>
                    <?php $__currentLoopData = explode(';', $student->workExperience); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(trim($experience) !== ''): ?>
                            <div class="mb-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                <p class="text-gray-700"><?php echo e($experience); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

        </div>

        <!-- Idiomas y Contacto en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

            <!-- Idiomas -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Idiomas</h3>
                <div>
                    <?php $__currentLoopData = explode(';', $student->languages); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(trim($language) !== ''): ?>
                            <div class="mb-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                <p class="text-gray-700"><?php echo e($language); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Contacto -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Contacto</h3>
                <div>
                    <?php $__currentLoopData = explode(';', $student->contact); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(trim($contact) !== ''): ?>
                            <div class="mb-2 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                <p class="text-gray-700"><?php echo e($contact); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-6 text-center">
        <a href="<?php echo e(route('projects.show', $student->idProject)); ?>" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">
            Volver al Proyecto
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/JornadasAutomocio2025/resources/views/students/show.blade.php ENDPATH**/ ?>