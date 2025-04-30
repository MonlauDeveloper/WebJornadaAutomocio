

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Subir CSV</h1>

        <form action="<?php echo e(route('projects.subircsv')); ?>" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label for="csvFile" class="block text-lg font-semibold text-blue-500">Archivo CSV</label>
                <input type="file" name="csvFile" id="csvFile" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".csv" required>
                <?php $__errorArgs = ['csvFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="text-center">
                <button type="submit" class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">Subir CSV</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/projects/upload_csv.blade.php ENDPATH**/ ?>