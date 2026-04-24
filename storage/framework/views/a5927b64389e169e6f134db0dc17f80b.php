<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4 md:p-8 min-h-screen">
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-extrabold text-blue-600 tracking-tight">Panel de Profesores</h1>
    </div>

    <!-- Filtros: Especialización, Curso, Verificación y Búsqueda -->
    <div class="p-6 mb-8">
        <form method="GET" action="<?php echo e(route('teachers.myStudents')); ?>" class="flex flex-col lg:flex-row items-center gap-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full lg:w-3/4">
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

                <select name="verification_status" onchange="this.form.submit()"
                    class="w-full border-gray-200 rounded-xl text-gray-600 p-3 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all cursor-pointer shadow-sm">
                    <option value="">Todos los estados</option>
                    <option value="pending" <?php echo e(request('verification_status') == 'pending' ? 'selected' : ''); ?>>Pendientes de Verificación</option>
                </select>
            </div>

            <div class="flex flex-col sm:flex-row w-full lg:w-1/4 gap-2">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Buscar..."
                    class="flex-grow w-full border-gray-200 rounded-xl px-4 py-3 text-gray-700 bg-gray-50 focus:ring-2 focus:ring-blue-500 shadow-sm">
                <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-xl font-medium transition-all transform active:scale-95 shadow-md">
                    Buscar
                </button>
            </div>
        </form>
    </div>

    <!-- Botón para cambiar la vista -->
    <div class="flex flex-col sm:flex-row justify-end items-center gap-4 mb-8 px-2">
        <button id="toggleView" class="w-full sm:w-auto justify-center bg-white text-gray-600 border border-gray-200 px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-all shadow-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            Cambiar Vista
        </button>
    </div>

    <!-- Vista de cuadrícula -->
    <div id="gridView" class="<?php echo e(request('view') == 'list' ? 'hidden' : ''); ?> grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300">
                <div class="w-28 mx-auto bg-white rounded-full shadow-sm border-4 border-white overflow-hidden mb-4">
                    <img class="w-full h-auto object-contain" 
                        src="<?php echo e($student->photoName ? asset('storage/' . $student->photoName) : asset('storage/photos/por_defecto/user_default.png')); ?>"
                        alt="<?php echo e($student->name); ?>"
                        onerror="this.onerror=null; this.src='<?php echo e(asset('storage/photos/por_defecto/user_default.png')); ?>';">
                </div>
                
                <h2 class="text-xl font-bold text-blue-600 text-center leading-tight">
                    <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

                </h2>
                
                <!-- Mostrar estado de verificación -->
                <div class="flex justify-center mt-3">
                    <i class="fas fa-<?php echo e($student->verification_status); ?> text-2xl <?php echo e($student->verification_status == 'check-circle' ? 'text-green-500' : 'text-gray-400'); ?>"></i>
                </div>

                <div class="mt-6 flex flex-col gap-2">
                    <a href="<?php echo e(route('professor.verifyDetails', $student->idStudent)); ?>"
                        class="text-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white py-2.5 rounded-xl font-semibold transition-colors text-sm">
                        Verificar
                    </a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full bg-white p-12 rounded-2xl text-center shadow-sm border border-dashed border-gray-300">
                <p class="text-gray-400">No se encontraron estudiantes pendientes de verificación o con los filtros seleccionados.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Vista de lista compacta (oculta por defecto) -->
    <div id="listView" class="<?php echo e(request('view') == 'list' ? '' : 'hidden'); ?> overflow-x-auto rounded-2xl shadow-sm border border-gray-200">
        <table class="w-full text-left bg-white border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider">Estudiante</th>
                    <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider">Curso</th>
                    <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider text-center">Estado</th>
                    <th class="p-4 font-semibold text-gray-600 uppercase text-xs tracking-wider text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-blue-50 transition-colors">
                        <td class="p-4 align-middle">
                            <div class="flex items-center gap-4">
                                <div class="w-16 flex-shrink-0 bg-white rounded-full shadow-sm border-4 border-white overflow-hidden">
                                    <img class="w-full h-auto object-contain" 
                                         src="<?php echo e($student->photoName ? asset('storage/' . $student->photoName) : asset('storage/photos/por_defecto/user_default.png')); ?>"
                                         alt="<?php echo e($student->name); ?>"
                                         onerror="this.onerror=null; this.src='<?php echo e(asset('storage/photos/por_defecto/user_default.png')); ?>';">
                                </div>
                                <div>
                                    <p class="text-base font-bold text-gray-800 leading-tight">
                                        <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 align-middle">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold tracking-wide">
                                <?php echo e($student->curso); ?>

                            </span>
                        </td>
                        <td class="p-4 align-middle text-center">
                            <i class="fas fa-<?php echo e($student->verification_status); ?> text-2xl <?php echo e($student->verification_status == 'check-circle' ? 'text-green-500' : 'text-gray-400'); ?>"></i>
                        </td>
                        <td class="p-4 text-right align-middle space-x-3">
                            <a href="<?php echo e(route('professor.verifyDetails', $student->idStudent)); ?>" 
                               class="text-blue-600 text-sm font-bold hover:text-blue-800 transition-colors">Verificar</a>
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

    <!-- Paginación con vista persistente -->
    <div class="mt-10">
        <?php echo e($students->appends(['specialization' => request('specialization'), 'curso' => request('curso'), 'search' => request('search'), 'verification_status' => request('verification_status'), 'view' => request('view')])->links()); ?>

    </div>

    <!-- Script para alternar entre vistas -->
    <script>
        document.getElementById('toggleView').addEventListener('click', function () {
            let currentView = "<?php echo e(request('view', 'grid')); ?>";
            let newView = currentView === 'grid' ? 'list' : 'grid';

            let url = new URL(window.location.href);
            url.searchParams.set('view', newView);
            window.location.href = url.toString();
        });
    </script>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/teachers/myStudents.blade.php ENDPATH**/ ?>