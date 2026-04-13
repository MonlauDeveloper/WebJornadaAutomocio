<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-600 tracking-tight">Lista de Proyectos</h1>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div class="max-w-2xl mx-auto mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex items-center justify-between" role="alert">
        <span class="font-medium"><?php echo e(session('success')); ?></span>
        <button onclick="this.parentElement.remove()" class="text-green-900">&times;</button>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="p-6 mb-8">
        <form method="GET" action="<?php echo e(route('projects.index')); ?>" class="flex flex-col gap-4">
            <div class="flex flex-wrap items-center justify-center gap-3">
                
                <select name="specialization" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todas las especializaciones</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($specialization->idSpecialization); ?>"
                        <?php echo e(request('specialization') == $specialization->idSpecialization ? 'selected' : ''); ?>>
                        <?php echo e($specialization->specialization); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>

                <select name="curso" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todos los cursos</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($curso); ?>" <?php echo e(request('curso') == $curso ? 'selected' : ''); ?>>
                        Curso <?php echo e($curso); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>

                <div class="relative inline-block text-left w-full sm:w-auto" style="min-width: 200px;">
                    <button type="button" 
                        onclick="document.getElementById('menu-tipos').classList.toggle('hidden')"
                        class="w-full rounded-xl text-gray-600 px-4 py-2.5 bg-gray-50 flex items-center justify-between gap-2 border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition"> 
                        <span>Tipos de proyecto</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div id="menu-tipos" class="hidden absolute z-20 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-xl p-3">
                        <div class="flex flex-col gap-2 max-h-60 overflow-y-auto custom-scrollbar">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $nombre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center p-2 hover:bg-blue-50 rounded-lg cursor-pointer transition">
                                    <input 
                                        type="checkbox" 
                                        name="tipos[]" 
                                        value="<?php echo e($id); ?>"
                                        class="form-checkbox h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                        <?php echo e((is_array(request('tipos')) && in_array($id, request('tipos'))) ? 'checked' : ''); ?>

                                    >
                                    <span class="ml-3 text-sm text-gray-700"><?php echo e($nombre); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mt-3 pt-2 border-t text-center">
                            <button type="button" 
                                onclick="document.getElementById('menu-tipos').classList.add('hidden'); this.form.submit()" 
                                class="text-xs text-blue-600 font-bold hover:text-blue-800 uppercase tracking-wider">
                                Aplicar Filtros
                            </button>
                        </div>
                    </div>
                </div>

                <select name="numTribunal" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todos los tribunales</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 20; $i++): ?>
                    <option value="<?php echo e($i); ?>" <?php echo e(request('numTribunal') == $i ? 'selected' : ''); ?>>
                        Tribunal <?php echo e($i); ?>

                    </option>
                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>

                <select name="idUbication" class="w-full sm:w-auto border-gray-300 rounded-xl text-gray-600 text-sm py-2.5 pl-4 pr-10 bg-gray-50 focus:ring-2 focus:ring-blue-500 transition cursor-pointer" onchange="this.form.submit()">
                    <option value="">Todas las ubicaciones</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ubication->idUbication); ?>" 
                            <?php echo e(request('idUbication') == $ubication->idUbication ? 'selected' : ''); ?>>
                            <?php echo e($ubication->ubicationName); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>

            <div class="flex flex-col sm:flex-row max-w-lg mx-auto w-full gap-2 mt-2">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por nombre de alumno..." 
                    class="w-full sm:flex-grow border border-gray-300 rounded-xl px-4 py-2 text-gray-700 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none shadow-sm transition">
                <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white hover:bg-blue-700 px-6 py-2 rounded-xl font-bold transition shadow-md active:scale-95">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
            <div class="relative h-48 w-full">
                <img class="w-full h-full object-cover" 
                    src="<?php echo e($project->photoName ? asset('storage/photos/' . $project->photoName) : asset('images/logoMonlau2026(2).png')); ?>" 
                    alt="<?php echo e($project->title); ?>"
                    onerror="this.onerror=null; this.src='<?php echo e(asset('images/logoMonlau2026(2).png')); ?>';">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
            </div>

            <div class="p-6 flex flex-col flex-grow">
                <h2 class="text-xl font-bold text-gray-800 leading-tight mb-2 truncate" title="<?php echo e($project->title); ?>"><?php echo e($project->title); ?></h2>
                <p class="text-gray-500 text-sm mb-4 line-clamp-3 leading-relaxed flex-grow">
                    <?php echo e(Str::limit($project->abstract, 100)); ?>

                </p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 mb-4 space-y-3">
                        <form method="POST" action="<?php echo e(route('projects.updateTribunalUbication')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="idProject" value="<?php echo e($project->idProject); ?>">
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Tribunal</label>
                                <select name="numTribunal" class="border-gray-200 rounded-lg text-xs py-1.5 pl-2 pr-8 w-full bg-white focus:ring-2 focus:ring-blue-400" onchange="this.form.submit()">
                                    <option value="">No asignado</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php for($i = 1; $i <= 20; $i++): ?>
                                    <option value="<?php echo e($i); ?>" <?php echo e($project->numTribunal == $i ? 'selected' : ''); ?>>Tribunal <?php echo e($i); ?></option>
                                    <?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </form>
                        
                        <form method="POST" action="<?php echo e(route('projects.updateTribunalUbication')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="idProject" value="<?php echo e($project->idProject); ?>">
                            <div class="flex flex-col gap-1">
                                <label class="text-[10px] font-bold text-blue-400 uppercase tracking-widest ml-1">Ubicación</label>
                                <select name="idUbication" class="border-gray-200 rounded-lg text-xs py-1.5 pl-2 pr-8 w-full bg-white focus:ring-2 focus:ring-blue-400" onchange="this.form.submit()">
                                    <option value="">No asignada</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ubication->idUbication); ?>" <?php echo e($project->idUbication == $ubication->idUbication ? 'selected' : ''); ?>>
                                            <?php echo e($ubication->ubicationName); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="<?php echo e(route('projects.show', $project->idProject)); ?>" 
                       class="flex-grow text-center bg-blue-600 text-white hover:bg-blue-700 py-2.5 rounded-xl font-bold text-sm shadow-sm transition active:scale-95">
                       Ver Detalles
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
                    <a href="<?php echo e(route('projects.edit', $project->idProject)); ?>" 
                       class="w-full sm:w-auto justify-center flex items-center bg-yellow-800 text-white hover:bg-yellow-900 px-4 py-2.5 rounded-xl text-sm transition shadow-sm active:scale-95">
                       Editar
                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-full py-12 text-center">
            <p class="text-gray-400 italic">No se han encontrado proyectos que coincidan con la búsqueda.</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="mt-10 w-full overflow-x-auto">
        <?php echo e($projects->appends(request()->query())->links()); ?>

    </div>
</div>

<script>
    // Cerrar menú al hacer clic fuera
    window.addEventListener('click', function(e) {
        const menu = document.getElementById('menu-tipos');
        const button = e.target.closest('button');
        if (menu && !button && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/projects/index.blade.php ENDPATH**/ ?>