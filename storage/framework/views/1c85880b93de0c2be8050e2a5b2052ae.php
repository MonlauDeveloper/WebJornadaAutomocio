

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Lista de Estudiantes</h1>

    <!-- Filtro de especialización y Buscador por nombre -->
    <div class="mb-6">
        <form method="GET" action="<?php echo e(route('students.index')); ?>" class="flex items-center justify-center gap-4">
            <!-- Filtro por especialización -->
            <select name="specialization" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todas las especializaciones</option>
                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($specialization->idSpecialization); ?>"
                    <?php echo e(request('specialization') == $specialization->idSpecialization ? 'selected' : ''); ?>>
                    <?php echo e($specialization->specialization); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <!-- Filtro por curso -->
            <select name="curso" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todos los cursos</option>
                <?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($curso); ?>"
                    <?php echo e(request('curso') == $curso ? 'selected' : ''); ?>>
                    Curso <?php echo e($curso); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <!-- Buscador por nombre -->
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por nombre" class="border rounded-lg px-4 py-2 text-gray-700">
            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">Buscar</button>
        </form>
        <?php if(auth()->user()->idRole === 1): ?>
            <div class="flex items-center justify-center mt-4">
            <button type="button" onclick="window.location.href='<?php echo e(route('students.create')); ?>'" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">Agregar nuevo Alumno</button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Listado de estudiantes -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
            <div class="mb-4">
                <img class="w-32 h-32 object-cover rounded-full mx-auto" src="<?php echo e(asset('storage/photos/' . $student->photoName)); ?>" alt="<?php echo e($student->name); ?>">
            </div>
            <h2 class="text-2xl font-bold text-blue-500 text-center"><?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?></h2>
            <p class="text-gray-600 mt-2 text-center"><?php echo e(Str::limit($student->introduction, 100)); ?></p>
            <div class="mt-4 text-center">
                <a href="<?php echo e(route('students.show', $student->idStudent)); ?>" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">Ver Detalles</a>
                <?php if(auth()->user()->idRole === 1): ?>
                    <a href="<?php echo e(route('students.edit', $student->idStudent)); ?>" class="text-white bg-yellow-800 hover:bg-yellow-900 py-2 px-4 rounded-lg">Editar</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-full text-center text-gray-500">No hay estudiantes disponibles para esta especialización o búsqueda.</p>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <div class="items-center justify-center mt-6">
        <?php echo e($students->appends(['specialization' => request('specialization'), 'search' => request('search')])->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/students/index.blade.php ENDPATH**/ ?>