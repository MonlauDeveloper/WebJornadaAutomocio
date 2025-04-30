

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Mi Proyecto</h1>

        <form action="<?php echo e(route('students.updateProject')); ?>" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
            <?php echo csrf_field(); ?>

            <!-- Título del Proyecto (bloqueado) -->
            <div>
                <label for="title" class="block text-lg font-semibold text-blue-500">Título del Proyecto</label>
                <input type="text" id="title" name="title" value="<?php echo e($project->title); ?>" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <!-- Especialización (bloqueado) -->
            <div>
                <label for="idSpecialization" class="block text-lg font-semibold text-blue-500">Especialización</label>
                <input type="text" id="idSpecialization" name="idSpecialization" value="<?php echo e($project->specialization ? $project->specialization->specialization : ''); ?>" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <!-- Foto del Proyecto -->
            <div>
                <label for="photoName" class="block text-lg font-semibold text-blue-500">Foto del Proyecto</label>
                <input type="file" id="photoName" name="photoName" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if($project->photoName): ?>
                    <p class="mt-2 text-sm text-gray-600">Archivo actual: <?php echo e($project->photoName); ?></p>
                <?php endif; ?>
            </div>

            <!-- Video del Proyecto -->
            <div>
                <label for="videoURL" class="block text-lg font-semibold text-blue-500">Enlace de Video de YouTube</label>
                <input type="url" id="videoURL" name="videoURL" value="<?php echo e($project->videoURL); ?>" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ingresa el enlace de YouTube">
                <?php if($project->videoURL): ?>
                    <p class="mt-2 text-sm text-gray-600">Enlace actual: <a href="<?php echo e($project->videoURL); ?>" target="_blank" class="text-blue-500"><?php echo e($project->videoURL); ?></a></p>
                <?php endif; ?>
            </div>

            <!-- Documento PDF -->
            <div>
                <label for="pdfURL" class="block text-lg font-semibold text-blue-500">Documento PDF del Proyecto</label>
                <input type="file" id="pdfURL" name="pdfURL" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if($project->pdfURL): ?>
                    <p class="mt-2 text-sm text-gray-600">Archivo actual: <?php echo e($project->pdfURL); ?></p>
                <?php endif; ?>
            </div>

            <!-- Descripción del Proyecto -->
            <div>
                <label for="abstract" class="block text-lg font-semibold text-blue-500">Descripción del Proyecto</label>
                <textarea id="abstract" name="abstract" rows="5" maxlength="300" class="mt-2 p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e($project->abstract); ?></textarea>
            </div>

            <!-- Botón de Actualización -->
            <div class="text-center">
                <button type="submit" class="mt-6 bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition">Actualizar Proyecto</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/students/myProject.blade.php ENDPATH**/ ?>