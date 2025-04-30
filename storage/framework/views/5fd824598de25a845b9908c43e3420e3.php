<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Editar Empresa</h1>

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc pl-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.update', $user->idUser)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Nombre de la Empresa -->
            <div>
                <label for="companyName" class="block text-sm font-medium text-gray-600">Nombre de la Empresa</label>
                <input type="text" name="companyName" id="companyName" value="<?php echo e(old('companyName', $user->company->companyName)); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <!-- Página Web -->
            <div>
                <label for="companyWeb" class="block text-sm font-medium text-gray-600">Página Web</label>
                <input type="url" name="companyWeb" id="companyWeb" value="<?php echo e(old('companyWeb', $user->company->companyWeb)); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Asistente -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="asistenteNombre" class="block text-sm font-medium text-gray-600">Nombre del Asistente</label>
                    <input type="text" name="asistenteNombre" id="asistenteNombre" value="<?php echo e(old('asistenteNombre', $user->company->asistenteNombre)); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="asistenteApellidos" class="block text-sm font-medium text-gray-600">Apellidos</label>
                    <input type="text" name="asistenteApellidos" id="asistenteApellidos" value="<?php echo e(old('asistenteApellidos', $user->company->asistenteApellidos)); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
            </div>

            <!-- Contacto -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="telefonoAsistente" class="block text-sm font-medium text-gray-600">Teléfono</label>
                    <input type="text" name="telefonoAsistente" id="telefonoAsistente" value="<?php echo e(old('telefonoAsistente', $user->company->telefonoAsistente)); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
                <div>
                    <label for="emailAsistente" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="emailAsistente" id="emailAsistente" value="<?php echo e(old('emailAsistente', $user->company->emailAsistente)); ?>"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>
            </div>

            <!-- Cargo -->
            <div>
                <label for="cargoAsistente" class="block text-sm font-medium text-gray-600">Cargo</label>
                <input type="text" name="cargoAsistente" id="cargoAsistente" value="<?php echo e(old('cargoAsistente', $user->company->cargoAsistente)); ?>"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <!-- Logo -->
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-600">Logo de la Empresa</label>
                <input type="file" name="logo" id="logo" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <?php if($user->company->logo_url): ?>
                    <div class="mt-2">
                        <img src="<?php echo e(asset('storage/photos/' . $user->company->logo_url)); ?>" alt="<?php echo e($user->username); ?>" class="w-32 h-32 object-cover mx-auto">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                Guardar Cambios
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/admin/edit.blade.php ENDPATH**/ ?>