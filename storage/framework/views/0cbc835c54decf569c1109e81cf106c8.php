<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-100">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Editar Asignación de Mesa</h2>
            <p class="text-gray-500 mt-2">Modificando mesa ID: <?php echo e($table->idTable); ?></p>
        </div>

        <form method="POST" action="<?php echo e(route('company-tables.update', $table->idTable)); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> 
            
            <div class="grid grid-cols-1 gap-6">
                
                <div>
                    <label for="idCompany" class="block text-gray-700 text-sm font-bold mb-2">Empresa Asignada</label>
                    <div class="relative">
                        <select name="idCompany" id="idCompany" required
                                class="w-full border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 appearance-none bg-white">
                            
                            <option value="" disabled>-- Selecciona una empresa --</option>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($company->idCompany); ?>" 
                                    <?php echo e($table->idCompany == $company->idCompany ? 'selected' : ''); ?>>
                                    <?php echo e($company->companyName); ?> (ID: <?php echo e($company->idCompany); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </select>
                        
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="tableName" class="block text-gray-700 text-sm font-bold mb-2">Nombre de la Mesa</label>
                    <input type="text" 
                           name="tableName" 
                           value="<?php echo e($table->tableName); ?>"
                           required 
                           class="w-full border rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex items-center justify-between mt-8">
                <a href="<?php echo e(route('mesas.index')); ?>" class="text-gray-500 hover:text-gray-700 font-semibold">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 font-bold py-2 px-8 rounded-lg shadow-md transition-all">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/mesas/edit.blade.php ENDPATH**/ ?>