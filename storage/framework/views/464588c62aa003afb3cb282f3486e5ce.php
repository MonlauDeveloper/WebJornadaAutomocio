<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Lista de Proyectos</h1>

    <!-- Mensaje de éxito -->
    <?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>

    <!-- Filtros: Especialización, Curso, Tribunal y Ubicación -->
    <div class="mb-6">
        <form method="GET" action="<?php echo e(route('projects.index')); ?>" class="flex flex-wrap items-center justify-center gap-4">
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
                <option value="<?php echo e($curso); ?>" <?php echo e(request('curso') == $curso ? 'selected' : ''); ?>>
                    Curso <?php echo e($curso); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <!-- Filtro por número de tribunal -->
            <select name="numTribunal" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todos los tribunales</option>
                <?php for($i = 1; $i <= 20; $i++): ?>
                <option value="<?php echo e($i); ?>" <?php echo e(request('numTribunal') == $i ? 'selected' : ''); ?>>
                    Tribunal <?php echo e($i); ?>

                </option>
                <?php endfor; ?>
            </select>

            <!-- Filtro por ubicación -->
            <select name="idUbication" class="border rounded-lg text-gray-700" onchange="this.form.submit()">
                <option value="">Todas las ubicaciones</option>
                <?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ubication->idUbication); ?>" 
                        <?php echo e(request('idUbication') == $ubication->idUbication ? 'selected' : ''); ?>>
                        <?php echo e($ubication->ubicationName); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <!-- Filtro por nombre de estudiante -->
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por nombre de Alumno" class="border rounded-lg px-4 py-2 text-gray-700">

            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">Buscar</button>
        </form>
    </div>

    <!-- Listado de proyectos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
            <div class="mb-4">
                <img class="w-full h-48 object-cover rounded-lg" src="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>" alt="<?php echo e($project->title); ?>">
            </div>
            <h2 class="text-2xl font-bold text-blue-500"><?php echo e($project->title); ?></h2>
            <p class="text-gray-600 mt-2"><?php echo e(Str::limit($project->abstract, 100)); ?></p>

            <?php if(auth()->user()->idRole === 1): ?>
                <!-- Formulario para actualizar Tribunal -->
                <div class="mt-4">
                    <form method="POST" action="<?php echo e(route('projects.updateTribunalUbication')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="idProject" value="<?php echo e($project->idProject); ?>">
                        
                        <div class="mb-2">
                            <select 
                                id="tribunal-<?php echo e($project->idProject); ?>" 
                                name="numTribunal" 
                                class="border rounded-lg text-gray-700 w-full"
                                onchange="this.form.submit()"
                            >
                                <option value="">Asignar Tribunal</option>
                                <?php for($i = 1; $i <= 20; $i++): ?>
                                <option value="<?php echo e($i); ?>" <?php echo e($project->numTribunal == $i ? 'selected' : ''); ?>>
                                    Tribunal <?php echo e($i); ?>

                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </form>
                    
                    <!-- Formulario para actualizar Ubicación -->
                    <form method="POST" action="<?php echo e(route('projects.updateTribunalUbication')); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="idProject" value="<?php echo e($project->idProject); ?>">
                        
                        <div>
                            <select 
                                id="ubication-<?php echo e($project->idProject); ?>" 
                                name="idUbication" 
                                class="border rounded-lg text-gray-700 w-full"
                                onchange="this.form.submit()"
                            >
                                <option value="">Asignar Ubicación</option>
                                <?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ubication->idUbication); ?>" 
                                        <?php echo e($project->idUbication == $ubication->idUbication ? 'selected' : ''); ?>>
                                        <?php echo e($ubication->ubicationName); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

            <div class="mt-4">
                <a href="<?php echo e(route('projects.show', $project->idProject)); ?>" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">Ver Detalles</a>
                <?php if(auth()->user()->idRole === 1): ?>
                    <a href="<?php echo e(route('projects.edit', $project->idProject)); ?>" class="text-white bg-yellow-800 hover:bg-yellow-900 py-2 px-4 rounded-lg">Editar</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-full text-center text-gray-500">No hay proyectos disponibles para tu busqueda.</p>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <div class="items-center justify-center mt-6">
        <?php echo e($projects->appends(['specialization' => request('specialization'), 'curso' => request('curso')])->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/projects/index.blade.php ENDPATH**/ ?>