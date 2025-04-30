<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Detalles de la Empresa</h1>
    
    <!-- Información de la empresa -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 w-11/12 md:w-1/2 mx-auto">
        <h2 class="text-xl font-semibold text-center text-gray-800 mb-4">Información de la Empresa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p><strong class="font-bold text-gray-700">Nombre de Empresa:</strong> <?php echo e($user->username); ?></p>
                <p><strong class="font-bold text-gray-700">Email:</strong> <?php echo e($user->email); ?></p>
                <p><strong class="font-bold text-gray-700">Página web:</strong> 
                    <a href="<?php echo e($user->company->companyWeb); ?>" class="text-blue-600 hover:text-blue-700" target="_blank" rel="noopener noreferrer">
                        <?php echo e($user->company->companyWeb); ?>

                    </a>
                </p>
            </div>
            <div>
                <p><strong class="font-bold text-gray-700">Nombre del Asistente:</strong> <?php echo e($user->company->asistenteNombre); ?> <?php echo e($user->company->asistenteApellidos); ?></p>
                <p><strong class="font-bold text-gray-700">Teléfono del Asistente:</strong> <?php echo e($user->company->telefonoAsistente); ?></p>
                <p><strong class="font-bold text-gray-700">Cargo del Asistente:</strong> <?php echo e($user->company->cargoAsistente); ?></p>
            </div>
        </div>
        <h2 class="text-l font-semibold text-center text-gray-800 mt-4 mb-4">Logo:</h2>
        <img class="w-32 h-32 object-cover mx-auto" 
                 src="<?php echo e(asset('storage/photos/' . $user->company->logo_url)); ?>" 
                 alt="<?php echo e($user->username); ?>">

    </div>

    <!-- Botones de acción -->
    <div class="flex justify-center gap-4 mb-6">
        <div class="flex justify-center">
        <a href="<?php echo e(route('admin.edit', $user->idUser)); ?>" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition duration-300">Editar</a>

        </div>

        <form action="<?php echo e(route('admin.solicitudes.deny', $user->idUser)); ?>" method="POST" class="inline">
            <?php echo csrf_field(); ?>
            <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-md shadow hover:bg-red-600 transition duration-300"
                onclick="return confirm('¿Estás seguro de que deseas denegar esta Empresa?');">
                Denegar
            </button>
        </form>
    </div>

    <!-- Botón Volver Atrás -->
    <div class="flex justify-center">
        <a href="<?php echo e(route('admin.empresas_aceptadas')); ?>" class="bg-gray-500 text-white px-6 py-3 rounded-md shadow hover:bg-gray-600 transition duration-300">
            Volver Atrás
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/admin/aprobadas_show.blade.php ENDPATH**/ ?>