<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($project->title); ?> | Monlau Automoción</title>
    
    <meta property="og:title" content="<?php echo e($project->title); ?>">
    <meta property="og:description" content="<?php echo e(Str::limit($project->abstract, 150)); ?>">
    <meta property="og:image" content="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>">
    <meta property="og:type" content="website">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 antialiased">

    <div class="container mx-auto p-4 md:p-10 max-w-5xl">
        <div class="bg-white p-6 md:p-10 rounded-3xl shadow-xl text-center border border-gray-100">

            <div class="flex flex-col items-center justify-center gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->idSpecialization == 5 && isset($logo)): ?>
                    <img src="<?php echo e(asset('storage/photos/' . $logo)); ?>" alt="Logo equipo" class="w-16 h-16 rounded-full shadow-md border-2 border-white">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <h1 class="text-4xl md:text-6xl font-extrabold text-slate-800 tracking-tight leading-tight">
                    <?php echo e($project->title); ?>

                </h1>
            </div>

            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 mt-6 text-slate-500 text-lg">
                <p><strong class="text-slate-800 font-bold">Categoría:</strong> <?php echo e($project->specialization->specialization ?? 'N/A'); ?></p>
                <p><strong class="text-slate-800 font-bold">Ubicación:</strong> <?php echo e($project->ubication->ubicationName ?? 'N/A'); ?></p>
                <p><strong class="text-slate-800 font-bold">Tribunal:</strong> <?php echo e($project->numTribunal); ?></p>
            </div>
            
            <div class="relative group mt-8">
                <img class="w-full max-w-4xl h-auto object-cover rounded-2xl mx-auto shadow-2xl border border-gray-100"
                    src="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>" alt="<?php echo e($project->title); ?>">
            </div>

            <div class="max-w-3xl mx-auto mt-10 text-left md:text-center">
                <h2 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4 text-center">Resumen del Proyecto</h2>
                <p class="text-slate-600 text-xl leading-relaxed break-words italic px-4">
                    "<?php echo e($project->abstract); ?>"
                </p>
            </div>

            <div class="w-full max-w-3xl mt-16 mx-auto">
                <p class="font-bold text-xl text-slate-800 border-b-2 border-slate-50 pb-2 mb-6">Vídeo de presentación</p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->videoURL): ?>
                    <div class="aspect-video w-full rounded-2xl overflow-hidden bg-slate-900 shadow-2xl">
                        <iframe class="w-full h-full" src="<?php echo e($project->embed_video_url); ?>" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                <?php else: ?>
                    <div class="bg-slate-50 rounded-2xl p-12 text-center border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 italic font-medium">Vídeo no disponible</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mt-12">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->idProject): ?>
                    <a href="<?php echo e(route('project.pdf', $project->idProject)); ?>"
                        class="inline-flex items-center gap-3 text-white bg-emerald-600 py-4 px-10 rounded-full text-lg font-bold shadow-lg shadow-emerald-100">
                        Ver Ficha Técnica
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="mt-10 bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
    <h2 class="text-2xl font-bold text-slate-800 mb-8 text-center md:text-left uppercase tracking-tighter">Equipo del proyecto</h2>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->students->isNotEmpty()): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('students.public', $student->idStudent)); ?>"
                   class="flex items-center p-4 rounded-2xl bg-slate-50 border border-slate-100 group transition-all hover:bg-white hover:shadow-md hover:border-blue-200">
                    
                    <div class="w-16 h-16 overflow-hidden rounded-full mr-4 border-4 border-white shadow-md group-hover:border-blue-50">
                        <img class="w-full h-full object-cover"
                            src="<?php echo e(asset('storage/' . $student->photoName)); ?>" 
                            alt="<?php echo e($student->name); ?>"
                            onerror="this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                    </div>

                    <div>
                        <p class="font-bold text-slate-800 text-lg">
                            <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

                        </p>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($student->isTeamLeader): ?>
                            <span class="inline-block mt-1 text-[10px] px-2 py-0.5 bg-amber-500 text-white rounded font-black uppercase tracking-tighter">Líder</span>
                        <?php else: ?>
                            <span class="text-xs text-slate-400 font-medium">Ver perfil</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php else: ?>
        <p class="text-slate-400 italic text-center">Información de equipo protegida.</p>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

        <footer class="mt-20 pb-10 border-t border-gray-100 pt-10 text-center">
            <div class="flex flex-col items-center gap-2">
                <p class="text-sm font-black text-slate-800 uppercase tracking-tighter">
                    Monlau Automoción
                </p>
                <p class="text-xs text-slate-400 font-medium">
                    &copy; <?php echo e(date('Y')); ?> — Centro de Estudios Monlau. Todos los derechos reservados.
                </p>
            </div>
        </footer>
    </div>
</body>
</html><?php /**PATH /var/www/jornada-automocion-api/resources/views/projects/public.blade.php ENDPATH**/ ?>