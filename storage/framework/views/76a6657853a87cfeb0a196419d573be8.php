<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-600 tracking-tight">Lista de Estudiantes</h1>
    </div>

    <div class="p-6 mb-8">
        <form method="GET" action="<?php echo e(route('students.index')); ?>" class="flex flex-col lg:flex-row items-center gap-4">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full lg:w-2/3">
                <select name="specialization" onchange="this.form.submit()"
                    class="w-full border-gray-200 rounded-xl text-gray-600 p-3 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer shadow-sm">
                    <option value="">Todas las especializaciones</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($specialization->idSpecialization); ?>" <?php echo e(request('specialization') == $specialization->idSpecialization ? 'selected' : ''); ?>>
                            <?php echo e($specialization->specialization); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>

                <select name="curso" onchange="this.form.submit()"
                    class="w-full border-gray-200 rounded-xl text-gray-600 p-3 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer shadow-sm">
                    <option value="">Todos los cursos</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $cursos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curso): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($curso); ?>" <?php echo e(request('curso') == $curso ? 'selected' : ''); ?>>
                            Curso <?php echo e($curso); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>

            <div class="flex flex-col sm:flex-row w-full lg:w-1/3 gap-2">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar por nombre..."
                    class="flex-grow w-full border-gray-200 rounded-xl px-4 py-3 text-gray-700 bg-gray-50 focus:ring-2 focus:ring-blue-500 shadow-sm">
                <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-xl font-medium transition-all transform active:scale-95 shadow-md">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-8 px-2">
        <div class="flex gap-3 w-full sm:w-auto">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
                <button type="button" onclick="window.location.href='<?php echo e(route('students.create')); ?>'"
                    class="w-full sm:w-auto justify-center bg-blue-600 text-white hover:bg-blue-700 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Nuevo Alumno
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        
        <button id="toggleView" class="w-full sm:w-auto justify-center bg-white text-gray-600 border border-gray-200 px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            Cambiar Vista
        </button>
    </div>

    <div id="gridView" class="<?php echo e(request('view') == 'list' ? 'hidden' : ''); ?> grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                
<div class="w-32 h-32 overflow-hidden rounded-full mx-auto bg-gray-100 border-2 border-gray-200 shadow-sm">
                        <img class="w-full h-auto object-contain" 
                            src="<?php echo e($student->photoName ? asset('storage/' . $student->photoName) : asset('storage/photos/por_defecto/user_default.png')); ?>"
                            alt="<?php echo e($student->name); ?>"
                            onerror="this.onerror=null; this.src='<?php echo e(asset('storage/photos/por_defecto/user_default.png')); ?>';">
                    </div>
                <h2 class="text-xl font-bold text-gray-800 text-center leading-tight">
                    <?php echo e($student->name); ?><br>
                    <span class="text-blue-500"><?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?></span>
                </h2>
                <p class="text-gray-500 mt-3 text-center text-sm leading-relaxed">
                    <?php echo e(Str::limit($student->introduction, 90)); ?>

                </p>
                
                <div class="mt-6 flex flex-col gap-2">
                    <a href="<?php echo e(route('students.show', $student->idStudent)); ?>"
                        class="text-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white py-2.5 rounded-xl font-semibold transition-colors">
                        Ver Perfil
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
                        <a href="<?php echo e(route('students.edit', $student->idStudent)); ?>"
                            class="text-center bg-yellow-50 text-yellow-800 hover:bg-yellow-800 hover:text-white py-2.5 rounded-xl font-semibold transition-colors text-sm">
                            Editar 
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full bg-white p-12 rounded-2xl text-center shadow-sm border border-dashed border-gray-300">
                <p class="text-gray-400">No se encontraron estudiantes con los criterios seleccionados.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div id="listView" class="<?php echo e(request('view') == 'list' ? '' : 'hidden'); ?> overflow-x-auto rounded-2xl shadow-sm border border-gray-200">
    <table class="w-full text-left bg-white border-collapse">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider w-40 text-center">Foto</th>
                <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider">Estudiante</th>
                <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider">Curso</th>
                <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider text-right">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-blue-50/50 transition-colors">
                    <td class="p-4 align-middle">
                        <div
                            class="w-16 h-16 overflow-hidden rounded-full mx-auto bg-gray-50 border border-gray-100 shadow-sm">
                            <img class="w-full h-full object-contain"
                                src="<?php echo e($student->photoName ? asset('storage/' . $student->photoName) : asset('storage/photos/por_defecto/user_default.png')); ?>" 
                                alt="<?php echo e($student->name); ?>"
                                onerror="this.onerror=null; this.src='<?php echo e(asset('storage/photos/por_defecto/user_default.png')); ?>';">
                        </div>
                    </td>
                    <td class="p-4 align-middle">
                        <div>
                            <p class="text-lg font-bold text-gray-800 leading-tight">
                                <?php echo e($student->name); ?> <?php echo e($student->surname1); ?>

                            </p>
                        </div>
                    </td>
                    <td class="p-4 align-middle">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm font-semibold">
                            <?php echo e($student->curso); ?>

                        </span>
                    </td>
                    <td class="p-4 text-right align-middle space-x-3">
                        <a href="<?php echo e(route('students.show', $student->idStudent)); ?>" 
                           class="text-blue-600 font-bold hover:text-blue-800 transition-colors">Ver Perfil</a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
                            <span class="text-gray-300">|</span>
                            <a href="<?php echo e(route('students.edit', $student->idStudent)); ?>" 
                               class="text-yellow-700 font-bold hover:text-yellow-900 transition-colors">Editar</a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="p-12 text-center text-gray-400">No hay datos para mostrar.</td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>

    <div class="mt-10">
        <?php echo e($students->appends(request()->query())->links()); ?>

    </div>
</div>

<script>
    document.getElementById('toggleView').addEventListener('click', function () {
        let currentView = "<?php echo e(request('view', 'grid')); ?>";
        let newView = currentView === 'grid' ? 'list' : 'grid';
        let url = new URL(window.location.href);
        url.searchParams.set('view', newView);
        window.location.href = url.toString();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/students/index.blade.php ENDPATH**/ ?>