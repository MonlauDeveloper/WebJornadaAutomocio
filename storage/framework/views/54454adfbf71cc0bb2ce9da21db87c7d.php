<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Editar Estudiante</h1>

    <form action="<?php echo e(route('students.update', $student->idStudent)); ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name', $student->name)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['name'];
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

        <!-- Apellido 1 -->
        <div class="mb-4">
            <label for="surname1" class="block text-gray-700 font-semibold mb-2">Primer Apellido</label>
            <input type="text" name="surname1" id="surname1" value="<?php echo e(old('surname1', $student->surname1)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['surname1'];
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

        <!-- Apellido 2 -->
        <div class="mb-4">
            <label for="surname2" class="block text-gray-700 font-semibold mb-2">Segundo Apellido</label>
            <input type="text" name="surname2" id="surname2" value="<?php echo e(old('surname2', $student->surname2)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['surname2'];
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

        <!-- Foto -->
        <div class="mb-4">
            <label for="photoName" class="block text-lg font-semibold text-blue-500">Foto</label>
            <input type="text" name="photoName" id="photoName" value="<?php echo e(old('photoName', $student->photoName)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['photoName'];
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

        <!-- Proyecto -->
        <div class="mb-4">
            <label for="idProject" class="block text-gray-700 font-semibold mb-2">Proyecto</label>
            <select name="idProject" id="idProject" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($project->idProject); ?>" <?php echo e(old('idProject', $student->idProject) == $project->idProject ? 'selected' : ''); ?>>
                        <?php echo e($project->title); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['idProject'];
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

        <!-- Introducción -->
        <div class="mb-4">
            <label for="introduction" class="block text-gray-700 font-semibold mb-2">Introducción</label>
            <textarea name="introduction" id="introduction" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"><?php echo e(old('introduction', $student->introduction)); ?></textarea>
            <?php $__errorArgs = ['introduction'];
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

        <!-- CV Link -->
        <div class="mb-4">
            <label for="cvLink" class="block text-gray-700 font-semibold mb-2">CV Link</label>
            <input type="text" name="cvLink" id="cvLink" value="<?php echo e(old('cvLink', $student->cvLink)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['cvLink'];
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

        <!-- Líder de Equipo -->
        <div class="mb-4">
            <label for="isTeamLeader" class="block text-gray-700 font-semibold mb-2">Líder de Equipo</label>
            <input type="checkbox" name="isTeamLeader" id="isTeamLeader" value="1" <?php echo e(old('isTeamLeader', $student->isTeamLeader) ? 'checked' : ''); ?> class="w-4 h-4 border-gray-300 rounded">
            <?php $__errorArgs = ['isTeamLeader'];
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


        <!-- Especialización -->
        <div class="mb-4">
            <label for="idSpecialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
            <select name="idSpecialization" id="idSpecialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($specialization->idSpecialization); ?>" <?php echo e(old('idSpecialization', $student->idSpecialization) == $specialization->idSpecialization ? 'selected' : ''); ?>>
                        <?php echo e($specialization->specialization); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['idSpecialization'];
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

        <!-- Curso -->
        <div class="mb-4">
            <label for="curso" class="block text-gray-700 font-semibold mb-2">Curso</label>
            <select name="curso" id="curso" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="A" <?php echo e(old('curso', $student->curso) == 'A' ? 'selected' : ''); ?>>A</option>           
                <option value="B" <?php echo e(old('curso', $student->curso) == 'B' ? 'selected' : ''); ?>>B</option>           
                <option value="C" <?php echo e(old('curso', $student->curso) == 'C' ? 'selected' : ''); ?>>C</option>           
                <option value="D" <?php echo e(old('curso', $student->curso) == 'D' ? 'selected' : ''); ?>>D</option>           
                <option value="E" <?php echo e(old('curso', $student->curso) == 'E' ? 'selected' : ''); ?>>E</option>           
                <option value="F" <?php echo e(old('curso', $student->curso) == 'F' ? 'selected' : ''); ?>>F</option>           
                <option value="R" <?php echo e(old('curso', $student->curso) == 'R' ? 'selected' : ''); ?>>R</option>           
                <option value="ONLINE" <?php echo e(old('curso', $student->curso) == 'ONLINE' ? 'selected' : ''); ?>>ONLINE</option>  
            </select>       
            <?php $__errorArgs = ['curso'];
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

        <!-- Equipo -->
        <div class="mb-4">
            <label for="idTeam" class="block text-gray-700 font-semibold mb-2">Equipo</label>
            <input type="text" name="idTeam" id="idTeam" value="<?php echo e(old('idTeam', $student->idTeam)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['idTeam'];
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

        <!-- Botones -->
        <div class="mt-6">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 py-2.5 px-4 rounded-lg">Guardar Cambios</button>
    </form>
            <form action="<?php echo e(route('students.destroy', $student->idStudent)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="mt-2 mb-4 text-white bg-red-800 hover:bg-red-900 py-2.5 px-4 rounded-lg" onclick="return confirm('¿Estás seguro que quieres eliminar este estudiante?');">Eliminar</button>
            </form>
            <a href="javascript:history.back()" class="mt-2 text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">Volver Atrás</a>
        </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/students/edit.blade.php ENDPATH**/ ?>