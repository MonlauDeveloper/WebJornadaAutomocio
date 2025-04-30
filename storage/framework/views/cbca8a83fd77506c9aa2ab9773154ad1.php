

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Panel de Profesores</h1>

    <!-- Filtros: Especialización, Curso y Búsqueda -->
    <div class="mb-6">
        <form method="GET" action="<?php echo e(route('teachers.myStudents')); ?>" class="flex items-center justify-center gap-4">
            <select name="specialization" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todas las especializaciones</option>
                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($specialization->idSpecialization); ?>"
                    <?php echo e(request('specialization') == $specialization->idSpecialization ? 'selected' : ''); ?>>
                    <?php echo e($specialization->specialization); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <select name="curso" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todos los cursos</option>
                <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($curso); ?>" <?php echo e(request('curso') == $curso ? 'selected' : ''); ?>>
                    Curso <?php echo e($curso); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <input type="text" name="search" placeholder="Buscar por nombre..." class="border rounded-lg text-gray-700 p-2" value="<?php echo e(request('search')); ?>" onchange="this.form.submit()">
        </form>
    </div>

    <!-- Listado de estudiantes -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
            <div class="mb-4">
                <img class="w-32 h-32 object-cover rounded-full mx-auto" src="<?php echo e(asset('storage/photos/' . $student->photoName)); ?>" alt="<?php echo e($student->name); ?>">
            </div>
            <h2 class="text-2xl font-bold text-blue-500 text-center"><?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?></h2>
            
            <!-- Mostrar estado de verificación -->
            <div class="flex justify-center mt-2">
                <i class="fas fa-<?php echo e($student->verification_status); ?> text-3xl"></i>
            </div>

            <div class="mt-4 text-center">
                <a href="<?php echo e(route('professor.verifyDetails', $student->idStudent)); ?>" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">
                    Verificar
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Paginación -->
    <div class="items-center justify-center mt-6">
        <?php echo e($students->appends(['specialization' => request('specialization'), 'curso' => request('curso'), 'search' => request('search')])->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/teachers/myStudents.blade.php ENDPATH**/ ?>