<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(public_path('build/assets/app-Cvpg7NpT.css')); ?>">
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-xl text-center border border-gray-100">
            <div class="flex items-center justify-center gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->idSpecialization == 5): ?>
                    <img src="<?php echo e(asset('storage/photos/' . $logo)); ?>" alt="Logo del equipo" class="w-12 h-12 rounded-full shadow-sm">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight"><?php echo e($project->title); ?></h1>
            </div>

            <p class="text-slate-500 mt-4 text-lg">
                <strong class="text-slate-700">Categoría: </strong><?php echo e($project->specialization ? $project->specialization->specialization : ''); ?>

            </p>
            <p class="text-slate-500 mt-2 text-lg">
                <strong class="text-slate-700">Ubicación: </strong><?php echo e($project->ubication ? $project->ubication->ubicationName : ''); ?>,
                <strong class="text-slate-700"> Tribunal: </strong><?php echo e($project->numTribunal); ?>

            </p>
            
            <img class="w-3xl h-auto object-cover rounded-xl mt-6 mx-auto shadow-md border border-gray-200"
                src="<?php echo e(asset('storage/photos/' . $project->photoName)); ?>" alt="<?php echo e($project->title); ?>">

            <p class="text-gray-600 mt-6 text-lg max-w-3xl mx-auto leading-relaxed break-words"><?php echo e($project->abstract); ?></p>

            <div class="w-full max-w-3xl mt-10 mx-auto">
                <p class="font-bold text-xl text-slate-800 border-b-2 border-slate-50 pb-2">Vídeo de presentación</p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->videoURL): ?>
                    <div class="aspect-video w-full rounded-xl overflow-hidden bg-slate-900 mt-4 shadow-lg">
                        <iframe class="w-full h-full" src="<?php echo e($project->embed_video_url); ?>" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                <?php else: ?>
                    <div class="bg-slate-50 rounded-lg p-8 mt-4 text-center border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 italic">Vídeo no disponible</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mt-8 flex flex-col items-center gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->idProject): ?>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-slate-700">Documentación:</span>
                        <a href="<?php echo e(route('project.pdf', $project->idProject)); ?>"
                            class="text-white bg-emerald-600 hover:bg-emerald-700 transition-colors py-2 px-6 rounded-full text-sm font-medium shadow-sm">
                            Ver Ficha Técnica
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if((auth()->user()->idRole === 1 || auth()->user()->idRole === 4) && $project->moodleURL): ?>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-slate-700">Moodle:</span>
                        <a href="<?php echo e($project->moodleURL); ?>"
                            class="inline-block bg-indigo-600 text-white py-2 px-6 rounded-full text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                            Acceder al curso
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <div class="mt-8 bg-white p-6 rounded-lg shadow-lg border border-gray-100">
            <h2 class="text-2xl font-bold text-slate-800 mb-6">Alumnos</h2>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->students->isNotEmpty()): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                            <a href="<?php echo e(route('students.show', $student->idStudent)); ?>" class="flex items-center group">
                                <div class="w-12 h-12 overflow-hidden rounded-full mr-4 bg-slate-100 border-2 border-white shadow-sm ring-1 ring-slate-200">
                                    <img class="w-full h-full object-cover object-top"
                                        src="<?php echo e(asset('storage/' . $student->photoName)); ?>" alt="<?php echo e($student->name); ?>"
                                        onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                                </div>
                                <div>
                                    <p class="font-bold text-slate-700 group-hover:text-blue-600 transition-colors">
                                        <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

                                    </p>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($student->isTeamLeader): ?>
                                        <span class="text-xs px-2 py-0.5 bg-amber-100 text-amber-700 rounded-full font-semibold italic">Líder del Proyecto</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php else: ?>
                <p class="text-slate-400 italic">No hay estudiantes asignados a este proyecto.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

       <div class="mt-8 flex justify-center gap-4">
    <a href="javascript:history.back()" class="text-gray-500 bg-gray-100 hover:bg-gray-200 py-2 px-8 rounded-lg transition font-medium">
        Volver al listado
    </a>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->idRole === 1): ?>
        <a href="<?php echo e(route('projects.edit', $project->idProject)); ?>"
            class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-8 rounded-lg transition font-medium shadow-md">
            Editar Proyecto
        </a>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/projects/show.blade.php ENDPATH**/ ?>