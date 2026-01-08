<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 mx-auto p-4 sm:p-6 bg-gray-50 min-h-screen">
    <div class="flex flex-col md:flex-row justify-betweem items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-semibold text-center text-blue-600">Gestión de Mesas</h1>
            <p class="text-gray-500 text-center">Administra la distribución de empresas en el recinto.</p>
        </div>
        <div class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-sm">
            <span class="text-2xl font-bold"><?php echo e($tables->count()); ?></span> Mesas Activas
        </div>
    </div>
    
    <div class="max-w-6xl mx-auto mb-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm animate-pulse">
                <div class="flex items-center">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                    <p class="font-medium "><?php echo e(session('success')); ?></p>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="bg-white p-6 rounded-3xl shadow-md border border-gray-300 mb-8 max-w-7xl mx-auto">
        <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
            <svg class="h-5 w-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Asignar Nueva Empresa a Mesa
        </h2>
        <form method="POST" action="<?php echo e(route('company-tables.store')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-gray-600 text-xs font-bold uppercase mb-1">Empresa</label>
                <select name="idCompany" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Selecciona empresa...</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($company->idCompany); ?>"><?php echo e($company->companyName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
            </div>
            <div>
                <label class="block text-gray-600 text-xs font-bold uppercase mb-1">Identificador de Mesa</label>
                <input type="text" name="tableName" required placeholder="Ej: A-12" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg transition duration-200 shadow-lg">
                Confirmar Asignación
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-7xl mx-auto">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center group-hover:bg-blue-50 transition-colors">
                    <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Mesa</span>
                    <span class="bg-white border border-blue-200 text-blue-700 px-2 py-1 rounded text-sm font-bold shadow-sm">
                        <?php echo e($table->tableName); ?>

                    </span>
                </div>
                
                <div class="p-5">
                    <h3 class="text-gray-900 font-bold text-lg mb-1 leading-tight"><?php echo e($table->companyName); ?></h3>
                    <p class="text-gray-400 text-sm mb-4">ID Empresa: <?php echo e($table->idCompany); ?></p>
                    
                    <div class="flex items-center text-gray-500 text-xs mb-6">
                        <svg class="h-4 w-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Ubicación confirmada
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-gray-50">
                        <a href="<?php echo e(route('company-tables.edit', $table->idTable)); ?>" class="text-blue-600 hover:text-blue-800 flex items-center text-sm font-semibold">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Editar
                        </a>
                        
                        <form action="<?php echo e(route('company-tables.destroy', $table->idTable)); ?>" method="POST" onsubmit="return confirm('¿Liberar esta mesa?');">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="text-red-400 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full py-20 text-center bg-white rounded-3xl border-2 border-dashed border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <p class="text-gray-500 text-lg">No hay mesas configuradas actualmente.</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/adminjornada/WebJornadaAutomocio1/resources/views/mesas/index.blade.php ENDPATH**/ ?>