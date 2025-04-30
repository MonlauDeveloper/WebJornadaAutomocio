<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h2 class="text-4xl font-bold text-blue-600 text-center">Ponentes de la Presentación: <?php echo e($presentation->presentationName); ?></h2>

        <!-- Mostrar mensaje de éxito -->
        <?php if(session('success')): ?>
            <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Lista de Ponentes -->
        <ul class="mt-8">
            <?php $__currentLoopData = $presentation->speakers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $speaker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="bg-gray-200 p-4 rounded-lg shadow-md mb-4">
                    <p><?php echo e($speaker->name); ?> <?php echo e($speaker->surname1); ?> <?php echo e($speaker->surname2); ?></p>
                    <p><?php echo e($speaker->description); ?></p>

                    <div class="mt-4 flex space-x-4">
                        <!-- Enlace para editar -->
                        <a href="<?php echo e(route('presentations.editSpeaker', [$presentation->idPresentation, $speaker->idSpeaker])); ?>" class="text-blue-500">Editar</a>

                        <!-- Formulario para eliminar ponente -->
                        <form action="<?php echo e(route('presentations.removeSpeaker', [$presentation->idPresentation, $speaker->idSpeaker])); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este ponente?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-500">Eliminar</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <!-- Formulario para agregar un nuevo ponente -->
        <h3 class="text-xl font-semibold text-blue-600 mt-6">Agregar un Nuevo Ponente</h3>
        <form action="<?php echo e(route('presentations.addSpeaker', $presentation->idPresentation)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mt-4">
                <label for="name" class="block text-sm text-gray-600">Nombre</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>

                <label for="surname1" class="block text-sm text-gray-600 mt-4">Primer Apellido</label>
                <input type="text" name="surname1" id="surname1" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>

                <label for="surname2" class="block text-sm text-gray-600 mt-4">Segundo Apellido</label>
                <input type="text" name="surname2" id="surname2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

                <label for="company" class="block text-sm text-gray-600 mt-4">Empresa</label>
                <input type="text" name="company" id="company" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

                <label for="description" class="block text-sm text-gray-600 mt-4">Descripción</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>

            <button type="submit" class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                Agregar Ponente
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/presentations/speaker.blade.php ENDPATH**/ ?>