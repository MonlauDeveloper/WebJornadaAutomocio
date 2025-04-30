<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <img class="w-32 h-32 object-cover rounded-full mx-auto" 
                 src="<?php echo e($student->photoName); ?>" 
                 alt="<?php echo e($student->name); ?>"
                 onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">

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
            <h3 class="text-xl font-semibold text-blue-600 mb-4">Sobre mí</h3>
            <p class="text-gray-700"><?php echo e($student->introduction ?? 'No especificada'); ?></p>
        </div>

        <!-- Contacto y Experiencia en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Contacto -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Contacto</h3>
                <div>
                    <?php $__empty_1 = true; $__currentLoopData = $student->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700"><?php echo e($contact->contact ?? 'No especificada'); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-700">No especificado</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Experiencia Laboral -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Experiencia Laboral</h3>
                <div>
                    <?php $__empty_1 = true; $__currentLoopData = $student->workExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700"><?php echo e($experience->work_experience ?? 'No especificada'); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-700">No especificada</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Educacion y Idiomas en dos columnas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

            <!-- Educación -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Formación</h3>
                <div>
                    <?php $__empty_1 = true; $__currentLoopData = $student->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700"><?php echo e($education->education ?? 'No especificada'); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-700">No especificada</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Idiomas -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-blue-600 mb-4">Idiomas</h3>
                <div>
                    <?php $__empty_1 = true; $__currentLoopData = $student->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M10 1a9 9 0 100 18A9 9 0 0010 1zm0 2a7 7 0 110 14A7 7 0 0110 3zm0 9a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                            <p class="text-gray-700"><?php echo e($language->language ?? 'No especificada'); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-gray-700">No especificado</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 text-center">
        <a href="<?php echo e(route('students.descargar', $student->idStudent)); ?>" class="mr-2 ml-2 text-white bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-lg">
            Descargar Currículum
        </a>
        <a href="<?php echo e(route('projects.show', $student->idProject)); ?>" class="mr-2 ml-2 text-white bg-blue-600 hover:bg-blue-700 py-3 px-6 rounded-lg">
            Ver Proyecto
        </a>
        <?php if(auth()->user()->idRole === 1): ?>
        <a href="<?php echo e(route('students.edit', $student->idStudent)); ?>" class="mr-2 ml-2 text-white bg-yellow-800 hover:bg-yellow-900 py-3 px-6 rounded-lg">
            Editar
        </a>
        <?php endif; ?>
        <a href="javascript:history.back()" class="text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">
            Volver Atrás
        </a>
    </div>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/students/show.blade.php ENDPATH**/ ?>