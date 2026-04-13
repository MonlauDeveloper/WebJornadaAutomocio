<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4 md:p-6">
    <h1 class="text-2xl md:text-3xl font-semibold text-center text-blue-600 mb-6">Empresas Aceptadas</h1>
    
    <div class="flex justify-center mb-6">
        <a href="<?php echo e(route('admin.create')); ?>" class="w-full md:w-auto text-center bg-blue-500 text-white hover:bg-blue-600 px-6 py-2 rounded-lg font-medium shadow transition">
            + Agregar nueva Empresa
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <table class="w-full">
            <thead class="hidden md:table-header-group bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nombre de Empresa</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-center">Acciones</th>
                </tr>
            </thead>
            
            <tbody class="block md:table-row-group text-gray-700">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $solicitudes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="block md:table-row border-b hover:bg-gray-50 transition">
                    
                    <td class="block md:table-cell px-4 py-2 md:py-4">
                        <span class="inline-block md:hidden font-bold text-blue-600 uppercase text-xs w-full mb-1">Empresa</span>
                        <div class="font-medium text-gray-900"><?php echo e($solicitud->username); ?></div>
                    </td>

                    <td class="block md:table-cell px-4 py-2 md:py-4">
                        <span class="inline-block md:hidden font-bold text-blue-600 uppercase text-xs w-full mb-1">Email</span>
                        <div class="text-gray-600"><?php echo e($solicitud->email); ?></div>
                    </td>

                    <td class="block md:table-cell px-4 py-4 md:py-4 text-center">
                        <span class="inline-block md:hidden font-bold text-blue-600 uppercase text-xs w-full mb-2 text-left">Acciones</span>
                        <div class="flex flex-col sm:flex-row justify-center gap-2">
                            <a href="<?php echo e(route('admin.aprobadas_show', $solicitud->idUser)); ?>" 
                               class="bg-blue-500 text-white px-4 py-2 rounded text-sm text-center hover:bg-blue-600 transition">
                               Detalles
                            </a>

                            <a href="<?php echo e(route('admin.edit', $solicitud->idUser)); ?>" 
                               class="bg-yellow-600 text-white px-4 py-2 rounded text-sm text-center hover:bg-yellow-700 transition">
                               Editar
                            </a>

                            <form action="<?php echo e(route('admin.solicitudes.deny', $solicitud->idUser)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" 
                                    class="w-full bg-red-500 text-white px-4 py-2 rounded text-sm hover:bg-red-600 transition"
                                    onclick="return confirm('¿Estás seguro?');">
                                    Denegar
                                </button>             
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php echo e($solicitudes->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/admin/empresas_aceptadas.blade.php ENDPATH**/ ?>