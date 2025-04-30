<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Crear Nuevo Estudiante</h1>

    <form action="<?php echo e(route('students.store')); ?>" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        <?php echo csrf_field(); ?>

        <!-- Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
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
            <input type="text" name="surname1" id="surname1" value="<?php echo e(old('surname1')); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
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
            <input type="text" name="surname2" id="surname2" value="<?php echo e(old('surname2')); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
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

        <!-- Especialización -->
        <div class="mb-4">
            <label for="idSpecialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
            <select name="idSpecialization" id="idSpecialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($specialization->idSpecialization); ?>"><?php echo e($specialization->specialization); ?></option>
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
            <label for="course" class="block text-gray-700 font-semibold mb-2">Curso</label>
            <select name="course" id="course" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="A" >A</option>           
                <option value="B" >B</option>           
                <option value="C" >C</option>           
                <option value="D" >D</option>           
                <option value="E" >E</option>           
                <option value="F" >F</option>           
                <option value="R" >R</option>           
                <option value="ONLINE" selected>ONLINE</option>  
            </select>         
            <?php $__errorArgs = ['course'];
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
            <label for="team" class="block text-gray-700 font-semibold mb-2">Equipo (opcional)</label>
            <input type="text" name="team" id="team" value="<?php echo e(old('team')); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
        </div>

        <!-- Proyecto -->
        <div class="mb-4">
            <label for="project" class="block text-gray-700 font-semibold mb-2">Proyecto (opcional)</label>
            <select name="idProject" id="idProject" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" onchange="toggleProjectForm()">
                <!-- Opción nula -->
                <option value="" selected>Nulo</option>
                <option value="new_project">Crear proyecto nuevo</option>
                <!-- Opciones de proyectos -->
                <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($project->idProject); ?>"><?php echo e($project->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <!-- Formulario para crear proyecto nuevo -->
        <div id="newProjectForm" class="hidden">
            <h2 class="text-2xl font-semibold text-blue-600 mb-4">Crear Nuevo Proyecto</h2>

            <!-- Título del Proyecto -->
            <div class="mb-4">
                <label for="project_title" class="block text-gray-700 font-semibold mb-2">Título del Proyecto</label>
                <input type="text" name="project_title" id="project_title" value="<?php echo e(old('project_title')); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__errorArgs = ['project_title'];
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

            <!-- Especialización del Proyecto -->
            <div class="mb-4">
                <label for="project_specialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
                <select name="project_specialization" id="project_specialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($specialization->idSpecialization); ?>"><?php echo e($specialization->specialization); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['project_specialization'];
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

            <!-- Curso del Proyecto -->
            <div class="mb-4">
                <label for="project_course" class="block text-gray-700 font-semibold mb-2">Curso</label>
                <select name="project_course" id="project_course" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="A" >A</option>           
                    <option value="B" >B</option>           
                    <option value="C" >C</option>           
                    <option value="D" >D</option>           
                    <option value="E" >E</option>           
                    <option value="F" >F</option>           
                    <option value="R" >R</option>           
                    <option value="ONLINE" selected>ONLINE</option>  
                </select>         
                <?php $__errorArgs = ['project_course'];
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

            <!-- Ubicación del Proyecto -->
            <div class="mb-4">
                <label for="project_ubication" class="block text-gray-700 font-semibold mb-2">Ubicación (opcional)</label>
                <select name="project_ubication" id="project_ubication" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="" selected>Seleccionar Ubicación</option>
                    <?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ubication->idUbication); ?>"><?php echo e($ubication->ubicationName); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['project_ubication'];
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

            <!-- Número de Tribunal -->
            <div class="mb-4">
                <label for="project_numTribunal" class="block text-gray-700 font-semibold mb-2">Número de Tribunal (opcional)</label>
                <select name="project_numTribunal" id="project_numTribunal" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="">Seleccionar Tribunal</option>
                    <?php for($i = 1; $i <= 20; $i++): ?>
                        <option value="<?php echo e($i); ?>">Tribunal <?php echo e($i); ?></option>
                    <?php endfor; ?>
                </select>
                <?php $__errorArgs = ['project_numTribunal'];
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
        </div>

        <!-- Botón -->
        <div class="mt-6">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 py-2.5 px-4 rounded-lg">Crear Estudiante</button>
        </div>

    </form>
</div>

<script>
    function toggleProjectForm() {
        var projectSelect = document.getElementById('idProject');
        var newProjectForm = document.getElementById('newProjectForm');
        if (projectSelect.value === 'new_project') {
            newProjectForm.classList.remove('hidden');
        } else {
            newProjectForm.classList.add('hidden');
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/students/create.blade.php ENDPATH**/ ?>