

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h2 class="text-4xl font-bold text-blue-600 text-center">Editar Presentación</h2>
    
    <!-- Formulario de edición de la presentación -->
    <form action="<?php echo e(route('presentations.update', $presentation->idPresentation)); ?>" method="POST" class="space-y-6 mt-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div>
            <label for="presentationName" class="block text-sm font-medium text-gray-600">Nombre de la Presentación</label>
            <input type="text" id="presentationName" name="presentationName" value="<?php echo e(old('presentationName', $presentation->presentationName)); ?>" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

        <div>
            <label for="topic" class="block text-sm font-medium text-gray-600">Tema</label>
            <input type="text" id="topic" name="topic" value="<?php echo e(old('topic', $presentation->topic)); ?>" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

        <div>
            <label for="presentationDate" class="block text-sm font-medium text-gray-600">Fecha de Presentación</label>
            <input type="date" id="presentationDate" name="presentationDate" value="<?php echo e(old('presentationDate', $presentation->presentationDate->format('Y-m-d'))); ?>" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

         <!-- Ubicación -->        
         <div class="mb-4">
            <label for="idUbication" class="block text-gray-700 font-semibold mb-2">Ubicación</label>
            <select name="idUbication" id="idUbication" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ubication->idUbication); ?>" 
                        <?php echo e(old('idUbication', $presentation->idUbication) == $ubication->idUbication ? 'selected' : ''); ?>>
                        <?php echo e($ubication->ubicationName); ?> <!-- Aquí el cambio -->
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['idUbication'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
            Actualizar Presentación
        </button>
    </form>
    <div class="mt-6">
        <!-- Formulario para eliminar presentación -->
        <form action="<?php echo e(route('presentations.destroy', $presentation->idPresentation)); ?>" method="POST" class="w-full">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            
            <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white py-2 px-6 rounded-lg transition" onclick="return confirm('¿Seguro que quieres eliminar esta ponencia?');">
                Eliminar Presentación
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/presentations/edit.blade.php ENDPATH**/ ?>