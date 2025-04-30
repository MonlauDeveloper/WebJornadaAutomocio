<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h2 class="text-4xl font-bold text-blue-600 text-center">Agregar Nueva Presentación</h2>
    
    <!-- Formulario para crear una nueva presentación -->
    <form action="<?php echo e(route('presentations.store')); ?>" method="POST" class="space-y-6 mt-6">
        <?php echo csrf_field(); ?>
        
        <div>
            <label for="presentationName" class="block text-sm font-medium text-gray-600">Nombre de la Presentación</label>
            <input type="text" id="presentationName" name="presentationName" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

        <div>
            <label for="topic" class="block text-sm font-medium text-gray-600">Tema</label>
            <input type="text" id="topic" name="topic" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required maxlength="300">
        </div>

        <div>
            <label for="presentationDate" class="block text-sm font-medium text-gray-600">Hora de Presentación</label>
            <input type="time" id="presentationDate" name="presentationDate" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                required>
        </div>

        <!-- Ubicación -->        
        <div class="mb-4">
            <label for="idUbication" class="block text-gray-700 font-semibold mb-2">Ubicación</label>
            <select name="idUbication" id="idUbication" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ubication->idUbication); ?>"><?php echo e($ubication->ubicationName); ?></option>
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
            Agregar Presentación
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/presentations/create.blade.php ENDPATH**/ ?>