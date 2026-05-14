<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo e($student->name); ?> | Monlau Automoción</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-slate-50 antialiased py-10">

<div class="container mx-auto px-4 max-w-5xl">
    
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 text-center mb-8">
        <div class="relative inline-block">
            <img class="w-32 h-32 object-cover object-top rounded-full mx-auto border-4 border-blue-50 shadow-md" 
                 src="<?php echo e(asset('storage/' . $student->photoName)); ?>" 
                 alt="<?php echo e($student->name); ?>"
                 onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
            <div class="absolute bottom-0 right-0 bg-green-500 w-6 h-6 rounded-full border-4 border-white"></div>
        </div>

        <h1 class="text-4xl font-extrabold text-slate-800 mt-6"><?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?></h1>
        
        <div class="flex flex-wrap justify-center gap-4 mt-4">
            <span class="bg-blue-50 text-blue-700 px-4 py-1 rounded-full text-sm font-bold">
                <?php echo e($student->specialization->specialization ?? 'Especialización no definida'); ?>

            </span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($student->team): ?>
            <span class="bg-slate-100 text-slate-600 px-4 py-1 rounded-full text-sm font-bold">
                Equipo: <?php echo e($student->team->teamName); ?>

            </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <div class="space-y-6">

        <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50">
            <h3 class="text-xl font-bold text-blue-600 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Sobre mí
            </h3>
            <p class="text-slate-600 leading-relaxed text-lg italic">
                "<?php echo e($student->introduction ?? 'Sin descripción profesional disponible.'); ?>"
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50">
                <h3 class="text-xl font-bold text-blue-600 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Contacto
                </h3>
                <div class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-center text-slate-700">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>
                            <p class="font-medium"><?php echo e($contact->contact); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-400 italic">No especificado</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50">
                <h3 class="text-xl font-bold text-blue-600 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Experiencia Laboral
                </h3>
                <div class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->workExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-start text-slate-700">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3 mt-2"></span>
                            <p class="font-medium"><?php echo e($experience->work_experience); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-400 italic">No especificada</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50">
                <h3 class="text-xl font-bold text-blue-600 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9-5V11l9 5 9-5V9l-9 5z"></path></svg>
                    Formación
                </h3>
                <div class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-start text-slate-700">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3 mt-2"></span>
                            <p class="font-medium"><?php echo e($education->education); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-400 italic">No especificada</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-50">
                <h3 class="text-xl font-bold text-blue-600 mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5l-1.043 2.5M7 7a10.05 10.05 0 013 4.5M6.412 9a9 9 0 003.188 4.5m0 0a15.05 15.05 0 01-3.5 3.5m3.5-3.5c1.351 1 2.426 2.355 3 4M3 7h3.362"></path></svg>
                    Idiomas
                </h3>
                <div class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $student->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-center text-slate-700">
                            <span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>
                            <p class="font-medium"><?php echo e($language->language); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-slate-400 italic">No especificado</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 flex flex-wrap justify-center gap-4 text-center">
        <a href="<?php echo e(route('students.descargar', $student->idStudent)); ?>?t=<?php echo e(time()); ?>" target="_blank"
           class="bg-emerald-600 text-white font-bold py-4 px-8 rounded-2xl shadow-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Ver Currículum
        </a>

        <a href="javascript:history.back()" 
           class="bg-slate-200 text-slate-700 font-bold py-4 px-8 rounded-2xl">
            Volver Atrás
        </a>
    </div>

    <footer class="mt-16 text-center text-slate-400 text-sm">
        <p class="font-bold text-slate-800 uppercase tracking-widest">Monlau Automoción</p>
        <p class="text-xs text-slate-400 font-medium">
            &copy; <?php echo e(date('Y')); ?> — Centro de Estudios Monlau. Todos los derechos reservados.
        </p>
    </footer>

</div>
</body>
</html><?php /**PATH /var/www/jornada-automocion-api/resources/views/students/public.blade.php ENDPATH**/ ?>