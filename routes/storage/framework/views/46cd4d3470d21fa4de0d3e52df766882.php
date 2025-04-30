

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <!-- Formulario para Crear Proyecto -->
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Crear Proyecto</h1>

        <form action="<?php echo e(route('projects.store')); ?>" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            <?php echo csrf_field(); ?>
            <!-- Título del Proyecto -->
            <div>
                <label for="title" class="block text-lg font-semibold text-blue-500">Título del Proyecto</label>
                <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <?php $__errorArgs = ['title'];
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

             <!-- Categoria del Proyecto -->
             <div>
                <label for="categoria" class="block text-lg font-semibold text-blue-500">Categoría del Proyecto</label>
                <input type="text" name="categoria" id="categoria" value="<?php echo e(old('categoria')); ?>" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <?php $__errorArgs = ['categoria'];
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

            <!-- Foto del Proyecto -->
            <div>
                <label for="photoName" class="block text-lg font-semibold text-blue-500">Foto del Proyecto</label>
                <input type="file" name="photo" id="photo" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>

                <?php $__errorArgs = ['photoName'];
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

            <!-- Resumen del Proyecto -->
            <div>
                <label for="abstract" class="block text-lg font-semibold text-blue-500">Resumen del Proyecto</label>
                <textarea name="abstract" id="abstract" rows="4" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required><?php echo e(old('abstract')); ?></textarea>
                <?php $__errorArgs = ['abstract'];
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

            <!-- Video del Proyecto -->
            <div>
                <label for="videoFile" class="block text-lg font-semibold text-blue-500">Archivo de Video</label>
                <input type="file" name="videoFile" id="videoFile" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="video/*">

                <?php $__errorArgs = ['videoFile'];
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

            <!-- URL del PDF -->
            <div>
                <label for="pdfURL" class="block text-lg font-semibold text-blue-500">URL del PDF</label>
                <input type="url" name="pdfURL" id="pdfURL" value="<?php echo e(old('pdfURL')); ?>" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <?php $__errorArgs = ['pdfURL'];
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

            <!-- URL de Moodle -->
            <div>
                <label for="moodleURL" class="block text-lg font-semibold text-blue-500">URL de Moodle (Opcional)</label>
                <input type="url" name="moodleURL" id="moodleURL" value="<?php echo e(old('moodleURL')); ?>" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <?php $__errorArgs = ['moodleURL'];
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

            <!-- Botón de Enviar -->
            <div class="text-center">
                <button type="submit" class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">Crear Proyecto</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/projects/create.blade.php ENDPATH**/ ?>