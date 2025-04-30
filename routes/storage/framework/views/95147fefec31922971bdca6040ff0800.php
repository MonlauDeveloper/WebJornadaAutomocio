

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Editar Proyecto</h1>

    <form action="<?php echo e(route('projects.update', $project->idProject)); ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Título -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Título del Proyecto</label>
            <input type="text" name="title" id="title" value="<?php echo e(old('title', $project->title)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['title'];
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

        <!-- Resumen -->
        <div class="mb-4">
            <label for="abstract" class="block text-gray-700 font-semibold mb-2">Resumen</label>
            <textarea name="abstract" id="abstract" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"><?php echo e(old('abstract', $project->abstract)); ?></textarea>
            <?php $__errorArgs = ['abstract'];
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

        <!-- Categoría -->
        <div class="mb-4">
            <label for="categoria" class="block text-gray-700 font-semibold mb-2">Categoría</label>
            <input type="text" name="categoria" id="categoria" value="<?php echo e(old('categoria', $project->categoria)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['categoria'];
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

        <!-- Imagen -->
        <div class="mb-4">
            <label for="photo" class="block text-gray-700 font-semibold mb-2">Imagen</label>
            <input type="file" name="photo" id="photo" class="w-full">
            <?php if($project->photoName): ?>
                <p class="mt-2 text-sm text-gray-600">Imagen actual: <?php echo e($project->photoName); ?></p>
            <?php endif; ?>
            <?php $__errorArgs = ['photo'];
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

        <!-- Video -->
        <div class="mb-4">
            <label for="videoURL" class="block text-gray-700 font-semibold mb-2">Video (MP4)</label>
            <input type="file" name="videoURL" id="videoURL" class="w-full">
            <?php if($project->videoURL): ?>
                <p class="mt-2 text-sm text-gray-600">Video actual: <?php echo e($project->videoURL); ?></p>
            <?php endif; ?>
            <?php $__errorArgs = ['videoURL'];
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

        <!-- PDF -->
        <div class="mb-4">
            <label for="pdfURL" class="block text-gray-700 font-semibold mb-2">PDF</label>
            <input type="file" name="pdfURL" id="pdfURL" class="w-full">
            <?php if($project->pdfURL): ?>
                <p class="mt-2 text-sm text-gray-600">PDF actual: <?php echo e($project->pdfURL); ?></p>
            <?php endif; ?>
            <?php $__errorArgs = ['pdfURL'];
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

        <!-- Moodle URL -->
        <div class="mb-4">
            <label for="moodleURL" class="block text-gray-700 font-semibold mb-2">URL de Moodle</label>
            <input type="url" name="moodleURL" id="moodleURL" value="<?php echo e(old('moodleURL', $project->moodleURL)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['moodleURL'];
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

        <!-- Botón de enviar -->
        <div class="mt-6">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">Guardar Cambios</button>
            <a href="<?php echo e(route('projects.index')); ?>" class="text-white bg-gray-600 hover:bg-gray-700 py-2 px-4 rounded-lg ml-4">Cancelar</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/projects/edit.blade.php ENDPATH**/ ?>