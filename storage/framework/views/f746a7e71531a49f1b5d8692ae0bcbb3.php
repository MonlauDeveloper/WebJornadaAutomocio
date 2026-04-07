<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:py-10 sm:px-6 lg:px-8">
    
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight text-center md:text-left">Gestión de Equipos</h1>
            <p class="mt-2 text-sm text-gray-500 text-center md:text-left">Administra los equipos disponibles para asignar a los alumnos.</p>
        </div>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm flex items-center">
            <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
            <span class="text-green-700 font-medium text-sm sm:text-base"><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
                <span class="text-red-700 font-bold">Han ocurrido errores:</span>
            </div>
            <ul class="list-disc list-inside text-red-600 text-sm ml-4 sm:ml-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </ul>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="bg-white p-5 sm:p-6 rounded-xl shadow-sm border border-gray-100 mb-8">
        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center justify-center sm:justify-start">
            <i class="fas fa-plus-circle text-blue-600 mr-2"></i> Añadir Nuevo Equipo
        </h2>
        <form action="<?php echo e(route('admin.teams.store')); ?>" method="POST" class="flex flex-col sm:flex-row gap-4 items-end">
            <?php echo csrf_field(); ?>
            <div class="w-full">
                <label for="teamName" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Equipo</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-users text-gray-400"></i>
                    </div>
                    <input type="text" name="teamName" id="teamName" placeholder="Ej: Equipo A..." 
                           class="pl-10 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base" required>
                </div>
            </div>
            <button type="submit" class="w-full sm:w-auto whitespace-nowrap bg-blue-600 text-white font-semibold px-6 py-2.5 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 transition duration-150">
                <i class="fas fa-save mr-2"></i> <span class="sm:inline">Crear Equipo</span>
            </button>
        </form>
    </div>

    <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 hidden md:table-header-group">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-24">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nombre del Equipo</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider w-32">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 block md:table-row-group">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-blue-50 transition-colors duration-150 group block md:table-row border-b md:border-none">
                        
                        <td class="px-6 py-3 md:py-4 whitespace-nowrap block md:table-cell">
                            <div class="flex items-center justify-between md:justify-start">
                                <span class="md:hidden text-xs font-bold text-gray-400 uppercase">ID:</span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                    #<?php echo e($team->idTeam); ?>

                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-3 md:py-4 block md:table-cell">
                            <form action="<?php echo e(route('admin.teams.update', $team->idTeam)); ?>" method="POST" class="flex flex-col sm:flex-row gap-2 items-center">
                                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                <div class="w-full relative">
                                    <input type="text" name="teamName" value="<?php echo e($team->teamName); ?>" 
                                           class="block w-full border-gray-200 bg-gray-50 md:border-transparent md:bg-transparent rounded-md focus:border-blue-500 focus:bg-white focus:ring focus:ring-blue-200 transition px-3 py-2 text-sm text-gray-900 font-semibold" required>
                                </div>
                                <button type="submit" class="w-full sm:w-auto flex-shrink-0 bg-green-600 md:bg-green-100 text-white md:text-green-700 hover:bg-green-700 md:hover:bg-green-200 px-4 py-2 md:py-1.5 rounded-lg text-xs font-bold transition">
                                    <i class="fas fa-check mr-1"></i> Guardar
                                </button>
                            </form>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium block md:table-cell bg-gray-50 md:bg-transparent">
                            <form action="<?php echo e(route('admin.teams.destroy', $team->idTeam)); ?>" method="POST" class="w-full md:w-auto" onsubmit="return confirm('¿Eliminar equipo?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 text-red-500 hover:text-white hover:bg-red-500 border border-red-200 md:border-none md:bg-red-50 md:hover:bg-red-100 px-4 py-2 md:px-3 md:py-1.5 rounded-lg transition duration-150">
                                    <i class="fas fa-trash-alt"></i>
                                    <span class="md:hidden font-bold">Eliminar Equipo</span>
                                </button>
                            </form>
                        </td>

                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                                <p class="text-sm font-medium">No hay equipos creados todavía</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($teams->hasPages()): ?>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <?php echo e($teams->links()); ?>

        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/teams/index.blade.php ENDPATH**/ ?>