

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <!-- Lista de Ponentes de la Empresa -->
        <h2 class="text-4xl font-bold text-blue-600 text-center">Ponentes de tu Empresa</h2>
        <div class="mt-4">
        <?php $__empty_1 = true; $__currentLoopData = $speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-gray-100 p-4 rounded-lg shadow-lg mb-4">
                <h3 class="text-xl font-semibold text-gray-800"><?php echo e($speaker->name); ?> <?php echo e($speaker->surname1); ?> <?php echo e($speaker->surname2); ?></h3>
                <p class="text-gray-600"><?php echo e($speaker->description); ?></p>
                <p class="text-gray-500 text-sm">Fecha de Nacimiento: <?php echo e(\Carbon\Carbon::parse($speaker->birthDate)->locale('es')->isoFormat('D [de] MMMM [de] YYYY')); ?></p>
                <div class="flex space-x-4 mt-2">
                    <a href="<?php echo e(route('companies.editSpeaker', $speaker->idSpeaker)); ?>" 
                        class="text-blue-500 hover:text-blue-700">Editar</a>
                    <form action="<?php echo e(route('companies.deleteSpeaker', $speaker->idSpeaker)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ponente?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-gray-600 text-center">No hay ponentes disponibles. Puedes agregar nuevos ponentes.</p>
        <?php endif; ?>
        </div>

        <h1 class="text-4xl font-bold text-blue-600 text-center mt-8">Agregar Ponente</h1>
        <!-- Mensajes de éxito o error -->
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php elseif(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4 mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <!-- Si no existen ponentes, mostrar el formulario para crear uno -->
            <form action="<?php echo e(route('companies.createSpeaker')); ?>" method="POST" class="space-y-6 mt-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-600">Nombre</label>
                    <input type="text" id="name" name="name" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        required>
                </div>

                <div>
                    <label for="surname1" class="block text-sm font-medium text-gray-600">Primer Apellido</label>
                    <input type="text" id="surname1" name="surname1" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        required>
                </div>

                <div>
                    <label for="surname2" class="block text-sm font-medium text-gray-600">Segundo Apellido</label>
                    <input type="text" id="surname2" name="surname2" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-600">Descripción</label>
                    <textarea id="description" name="description" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        rows="3"></textarea>
                </div>

                <div>
                    <label for="birthDate" class="block text-sm font-medium text-gray-600">Fecha de Nacimiento</label>
                    <input type="date" id="birthDate" name="birthDate" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        required>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                    Agregar Ponente
                </button>
            </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/companies/speaker.blade.php ENDPATH**/ ?>