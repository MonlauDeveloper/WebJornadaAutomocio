<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h2 class="text-4xl font-bold text-blue-600 text-center">Lista de Presentaciones</h2>

    <!-- Botón para agregar una nueva presentación -->
    <div class="mt-6">
        <a href="<?php echo e(route('presentations.create')); ?>" class="bg-blue-500 text-white py-2 px-6 rounded-lg">Agregar Nueva Presentación</a>
    </div>

    <!-- Mostrar todas las presentaciones -->
    <ul class="mt-6 space-y-4">
        <?php $__currentLoopData = $presentations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $presentation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="bg-gray-100 p-4 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-gray-800"><?php echo e($presentation->presentationName); ?></h3>
                <p class="text-gray-600"><?php echo e($presentation->topic); ?></p>
                <p class="text-gray-500 text-sm">Hora de presentación: <?php echo e(\Carbon\Carbon::parse($presentation->presentationDate)->format('H:i')); ?></p>
                <p class="text-gray-600">Ponentes:</p>
                <?php $__currentLoopData = $presentation->speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-gray-500 text-sm"><?php echo e($speaker->name); ?> <?php echo e($speaker->surname1); ?> <?php echo e($speaker->surname2); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <!-- Enlace para editar la presentación -->
                <div class="mt-4">
                    <a href="<?php echo e(route('presentations.edit', $presentation->idPresentation)); ?>" class="text-blue-500">Editar</a>
                    |
                    <a href="<?php echo e(route('presentations.speaker', $presentation->idPresentation)); ?>" class="text-blue-500">Gestionar Ponentes</a>
                </div>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/presentations/index.blade.php ENDPATH**/ ?>