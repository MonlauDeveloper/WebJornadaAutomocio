<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Lista de Proyectos</h1>

    <!-- Filtro de especialización -->
    <div class="mb-6">
        <form method="GET" action="<?php echo e(route('projects.index')); ?>" class="flex items-center justify-center gap-4">
            <select name="specialization" class="border rounded-lg text-gray-700">
                <option onclick="filter('')" value="">Todas las especializaciones</option>
                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option onclick="filter('<?php echo e($specialization->idSpecialization); ?>')" value="<?php echo e($specialization->idSpecialization); ?>"
                    <?php echo e(request('specialization') == $specialization->idSpecialization ? 'selected' : ''); ?>>
                    <?php echo e($specialization->specialization); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Filtrar
            </button>
        </form>
    </div>

    <!-- Listado de proyectos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
            <div class="mb-4">
                <img class="w-full h-48 object-cover rounded-lg" src="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>" alt="<?php echo e($project->title); ?>">
            </div>
            <h2 class="text-2xl font-bold text-blue-500"><?php echo e($project->title); ?></h2>
            <p class="text-gray-600 mt-2"><?php echo e(Str::limit($project->abstract, 100)); ?></p>
            <div class="mt-4">
                <a href="<?php echo e(route('projects.show', $project->idProject)); ?>" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">Ver Detalles</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-full text-center text-gray-500">No hay proyectos disponibles para esta especialización.</p>
        <?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/projects/index.blade.php ENDPATH**/ ?>