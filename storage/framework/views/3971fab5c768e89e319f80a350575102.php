<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4 md:p-6"> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div id="status-message" class="mb-4 transition-opacity duration-500">
            <div class="px-4 py-3 rounded-lg border <?php echo e($votingStatus ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'); ?> shadow-sm">
                <div class="flex items-center text-sm md:text-base"> <span class="mr-2"><?php echo e($votingStatus ? '✅' : '🚫'); ?></span>
                    <span class="font-bold"><?php echo e(session('success')); ?></span>
                </div>
            </div>
        </div>

        <script>
            setTimeout(function() {
                const message = document.getElementById('status-message');
                if (message) {
                    message.style.opacity = '0';
                    setTimeout(() => message.remove(), 500);
                }
            }, 3000);
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
    <h1 class="text-2xl md:text-3xl font-semibold text-blue-600 text-center md:text-left">
        Ranking de Votos
    </h1>
    
    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
        
        <form action="<?php echo e(route('admin.votes.toggle')); ?>" method="POST" class="w-full md:w-auto text-center">
            <?php echo csrf_field(); ?>
            <button type="submit" 
                class="w-full md:w-auto px-6 py-2 rounded-lg font-bold text-white transition <?php echo e($votingStatus ? 'bg-red-500' : 'bg-green-600'); ?>">
                <?php echo e($votingStatus ? 'Desactivar Votaciones' : 'Activar Votaciones'); ?>

            </button>
        </form>

        <form action="<?php echo e(route('admin.votes.reset')); ?>" method="POST" class="w-full md:w-auto" 
              onsubmit="return confirm('⚠️ ¿ESTÁS SEGURO? Se borrarán TODOS los votos permanentemente.');">
            <?php echo csrf_field(); ?>
            <button type="submit" 
                class="w-full md:w-auto px-6 py-2 rounded-lg font-bold text-white transition bg-blue-600 shadow-md hover:bg-blue-700">
                Reiniciar Votaciones
            </button>
        </form>
        
    </div>
</div>

    <div class="bg-white shadow-md rounded-lg border border-gray-200 overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md">
    <thead class="bg-blue-100">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posición</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proyecto</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Votos</th>
            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Detalles</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="px-6 py-4 font-bold text-blue-600">#<?php echo e($index + 1); ?></td>
            <td class="px-6 py-4">
                <div class="font-medium text-gray-900"><?php echo e($project->title); ?></div>
                <div class="text-sm text-gray-500"><?php echo e($project->specialization->specialization); ?></div>
            </td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full font-bold">
                    <?php echo e($project->votes_count); ?> votos
                </span>
            </td>
            <td class="px-6 py-4 text-center">
                <a href="<?php echo e(route('projects.show', $project->idProject)); ?>" 
                   class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-bold rounded transition">
                   Ver Proyecto
                </a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </tbody>
</table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/votes/index.blade.php ENDPATH**/ ?>