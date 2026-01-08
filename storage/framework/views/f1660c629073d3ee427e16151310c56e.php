<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Lista de Proyectos</h1>

    <!-- Mensaje de éxito -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Filtros: Especialización, Curso, Tribunal y Ubicación -->
    <div class="mb-6">
        <form method="GET" action="<?php echo e(route('projects.index')); ?>" class="flex flex-wrap items-center justify-center gap-4">
            <!-- Filtro por especialización -->
            <select name="specialization" class="border rounded-lg text-gray-700 cursor-pointer" onchange="this.form.submit()">
                <option value="">Todas las especializaciones</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($specialization->idSpecialization); ?>"
                    <?php echo e(request('specialization') == $specialization->idSpecialization ? 'selected' : ''); ?>>
                    <?php echo e($specialization->specialization); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>

            <!-- Filtro por curso -->
            <select name="curso" class="border rounded-lg text-gray-700 cursor-pointer" onchange="this.form.submit()">
                <option value="">Todos los cursos</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($curso); ?>" <?php echo e(request('curso') == $curso ? 'selected' : ''); ?>>
                    Curso <?php echo e($curso); ?>

                </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>

            <!-- Filtro por tipo proyecto -->
           <div class="relative inline-block text-left" style="min-width: 200px;">
    
            <button type="button" 
                onclick="document.getElementById('menu-tipos').classList.toggle('hidden')"
                class="w-full rounded-lg text-gray-700 px-4 py-2 bg-white flex items-center justify-between gap-2 focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 transition" style="border: 1px solid gray; transition: border-color 0.3s ease;"> 
    
                <span>Tipos de proyecto</span>
    
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div id="menu-tipos" class="hidden absolute z-10 mt-1 w-full bg-white border border-gray-400 rounded-lg shadow-lg p-3">
        
            <div class="flex flex-col gap-2 max-h-60 overflow-y-auto">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="inline-flex items-center cursor-pointer hover:bg-gray-100 p-1 rounded">
                        <input 
                            type="checkbox" 
                            name="tipos[]" 
                            value="<?php echo e($id); ?>"
                            class="form-checkbox h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                            <?php echo e((is_array(request('tipos')) && in_array($id, request('tipos'))) ? 'checked' : ''); ?>

                        >
                        <span class="ml-2 text-sm text-gray-700"><?php echo e($nombre); ?></span>
                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mt-3 pt-2 border-t text-center">
                <button type="button" 
                    onclick="document.getElementById('menu-tipos').classList.add('hidden'); this.form.submit()" 
                    class="text-xs text-blue-600 font-bold hover:underline">
                    Aplicar filtro
                </button>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('click', function(e) {
            const menu = document.getElementById('menu-tipos');
            const button = e.target.closest('button');
            // Si el clic NO fue en el botón ni dentro del menú, cerramos el menú
            if (!button && !menu.contains(e.target)) {
            // Check if menu exists before trying to manipulate its classList
            if(menu) {
                menu.classList.add('hidden');
            }
            }
        });
    </script>

            <!-- Filtro por número de tribunal -->
            <select name="numTribunal" class="border rounded-lg text-gray-700 cursor-pointer" onchange="this.form.submit()">
                <option value="">Todos los tribunales</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 20; $i++): ?>
                <option value="<?php echo e($i); ?>" <?php echo e(request('numTribunal') == $i ? 'selected' : ''); ?>>
                    Tribunal <?php echo e($i); ?>

                </option>
                <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>

            <!-- Filtro por ubicación -->
            <select name="idUbication" class="border rounded-lg text-gray-700 cursor-pointer" onchange="this.form.submit()">
                <option value="">Todas las ubicaciones</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ubication->idUbication); ?>" 
                        <?php echo e(request('idUbication') == $ubication->idUbication ? 'selected' : ''); ?>>
                        <?php echo e($ubication->ubicationName); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </select>

            <!-- Filtro por nombre de estudiante -->
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por nombre de Alumno" class="border rounded-lg px-4 py-2 text-gray-700">

            <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-lg">Buscar</button>
        </form>
    </div>

    <!-- Listado de proyectos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all">
            <div class="mb-4">
                <img class="w-full h-48 object-cover rounded-lg" src="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>" alt="<?php echo e($project->title); ?>">
            </div>
            <h2 class="text-2xl font-bold text-blue-500"><?php echo e($project->title); ?></h2>
            <p class="text-gray-600 mt-2"><?php echo e(Str::limit($project->abstract, 100)); ?></p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
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
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 20; $i++): ?>
                                <option value="<?php echo e($i); ?>" <?php echo e($project->numTribunal == $i ? 'selected' : ''); ?>>
                                    Tribunal <?php echo e($i); ?>

                                </option>
                                <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($ubication->idUbication); ?>" 
                                        <?php echo e($project->idUbication == $ubication->idUbication ? 'selected' : ''); ?>>
                                        <?php echo e($ubication->ubicationName); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>
                    </form>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="mt-4">
                <a href="<?php echo e(route('projects.show', $project->idProject)); ?>" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg">Ver Detalles</a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
                    <a href="<?php echo e(route('projects.edit', $project->idProject)); ?>" class="text-white bg-yellow-800 hover:bg-yellow-900 py-2 px-4 rounded-lg">Editar</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="col-span-full text-center text-gray-500">No hay proyectos disponibles para tu busqueda.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Paginación -->
    <div class="items-center justify-center mt-6">
        <?php echo e($projects->appends(['specialization' => request('specialization'), 'curso' => request('curso')])->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/adminjornada/WebJornadaAutomocio1/resources/views/projects/index.blade.php ENDPATH**/ ?>