<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h2 class="text-4xl font-bold text-blue-600 text-center">Editar Ponente</h2>
        
        <form action="<?php echo e(route('presentations.updateSpeaker', [$presentation->idPresentation, $speaker->idSpeaker])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mt-4">
                <label for="name" class="block text-sm text-gray-600">Nombre</label>
                <input type="text" id="name" name="name" value="<?php echo e($speaker->name); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mt-4">
                <label for="surname1" class="block text-sm text-gray-600">Primer Apellido</label>
                <input type="text" id="surname1" name="surname1" value="<?php echo e($speaker->surname1); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mt-4">
                <label for="surname2" class="block text-sm text-gray-600">Segundo Apellido</label>
                <input type="text" id="surname2" name="surname2" value="<?php echo e($speaker->surname2); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mt-4">
                <label for="company" class="block text-sm text-gray-600">Empresa</label>
                <input type="text" id="company" name="company" value="<?php echo e($speaker->company); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mt-4">
                <label for="description" class="block text-sm text-gray-600">Descripción</label>
                <textarea id="description" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"><?php echo e($speaker->description); ?></textarea>
            </div>

            <button type="submit" class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                Actualizar Ponente
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/presentations/editSpeaker.blade.php ENDPATH**/ ?>