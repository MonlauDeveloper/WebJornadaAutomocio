<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-blue-600 text-center">Mi Proyecto</h1>

            <!-- Mostrar el ícono de exclamación roja si el proyecto está incompleto -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($projectIncomplete): ?>
                <div class="text-center text-red-500 mt-4 mb-4">
                    <span class="text-5xl">❗</span>
                    <p class="mt-2">Tu proyecto está incompleto. Por favor, completa todos los campos.</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Mensajes de feedback -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
    <div id="success-message" class="js-feedback-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 text-center font-semibold animate-fade-in">
        <i class="fas fa-check-circle mr-2"></i><?php echo e(session('success')); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
    <div id="error-message" class="js-feedback-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 text-center font-semibold animate-fade-in">
        <i class="fas fa-times-circle mr-2"></i><?php echo e(session('error')); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form action="<?php echo e(route('projects.update', $project->idProject)); ?>" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-lg shadow-lg">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-semibold mb-2">Título del Proyecto</label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title', $project->title)); ?>" maxlength="100" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <p class="text-gray-500 text-xs mt-1">Máximo 100 caracteres</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="abstract" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                    <textarea name="abstract" id="abstract" rows="4" placeholder="Escribe aqui tu descripción del proyecto"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                        style="word-break: break-all;" maxlength="300"><?php echo e(old('abstract', $project->abstract)); ?></textarea>
                    <p class="text-gray-500 text-xs mt-1">Máximo 300 caracteres</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['abstract'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-7">
                        Tipos de Proyecto
                        <span class="text-sm text-gray-500 font-normal">(Mínimo 1, máximo 3)</span>
                    </label>

                    <div class="border border-gray-300 rounded-lg p-4 bg-white max-h-60 overflow-y-auto shadow-inner">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projectTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label
                                    class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded cursor-pointer transition">
                                    <input type="checkbox" name="tipos[]" value="<?php echo e($type->idProjectType); ?>"
                                        class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 project-type-checkbox"
                                        onclick="checkLimit(this)" <?php echo e($project->projectTypes && $project->projectTypes->contains('idProjectType', $type->idProjectType) ? 'checked' : ''); ?>>
                                    <span class="text-gray-700 font-medium ml-3"><?php echo e($type->name); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <p id="limit-message" class="text-xs text-gray-500 mt-2 font-semibold">
                        Seleccionados: <span
                            id="count-display"><?php echo e($project->projectTypes ? $project->projectTypes->count() : 0); ?></span>/3
                    </p>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['tipos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="photoName" class="block text-gray-700 font-semibold mb-2">Foto del Proyecto (Portada
                        Orla)</label>
                    <div class="flex items-center gap-4">
                        <input type="file" id="photoName" name="photoName"
                            class="p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->photoName && $project->photoName !== 'por_defecto/proyecto_default.png'): ?>
                            <button type="button"
                                onclick="if(confirm('¿Quieres eliminar esta foto y restaurar la imagen por defecto?')) document.getElementById('delete-main-photo-form').submit();"
                                class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white p-3 rounded-lg border border-blue-200 transition flex items-center justify-center"
                                title="Restaurar foto por defecto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                </svg>
                            </button>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->photoName): ?>
                        <div class="mt-3 flex items-center gap-4 p-2 border rounded-lg bg-gray-50">
                            <?php
                                $isCloudinary = str_contains($project->photoName, 'cloudinary.com');
                                $photoUrl = $isCloudinary ? $project->photoName : asset('storage/photos/' . $project->photoName);
                            ?>
                            <img src="<?php echo e($photoUrl); ?>" alt="Foto actual" class="h-16 w-16 object-contain bg-white rounded border">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-blue-600 uppercase">Archivo actual:</span>
                                <span class="text-[10px] text-gray-500 truncate max-w-xs"><?php echo e($project->photoName); ?></span>
                            </div>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="videoURL" class="block text-gray-700 font-semibold mb-2">Vídeo URL</label>
                    <input type="text" name="videoURL" id="videoURL" value="<?php echo e(old('videoURL', $project->videoURL)); ?>"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['videoURL'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        Galería y Pasos del Proyecto
                    </label>

                    <?php $totalFotos = $project->images->count(); ?>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-1 bg-white p-5 rounded-lg border border-gray-300 shadow-sm h-fit">
                            <div class="flex justify-between items-center mb-4 border-b pb-2">
                                <h3 class="text-sm font-bold text-gray-800 uppercase">Nueva Imagen</h3>
                                <span
                                    class="text-[10px] font-bold <?php echo e($totalFotos >= 6 ? 'text-red-500' : 'text-green-600'); ?>">
                                    <?php echo e($totalFotos); ?>/6
                                </span>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($totalFotos >= 6): ?>
                                <div class="bg-red-50 border border-red-200 text-red-700 p-2 rounded text-[10px] mb-4">
                                    <strong>Límite alcanzado.</strong> Borra una imagen para subir otra.
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="space-y-4 <?php echo e($totalFotos >= 6 ? 'opacity-40 pointer-events-none' : ''); ?>">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">1. Archivo</label>
                                    <input type="file" name="new_project_image" id="file_input_project" 
                                        class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white cursor-pointer"
                                    <?php echo e($totalFotos >= 6 ? 'disabled' : ''); ?>>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">2. Sección</label>
                                        <select name="new_image_fase" id="image_fase_selector" 
                                            class="block w-full rounded border-gray-300 text-xs shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="header">Portada</option>
                                            <option value="initial">Estado Inicial</option>
                                            <option value="procedimiento_1">Paso Técnico 1</option>
                                            <option value="procedimiento_2">Paso Técnico 2</option>
                                            <option value="procedimiento_3">Paso Técnico 3</option>
                                            <option value="final">Estado Final</option>
                                        </select>
                                    </div>


                                    <div class="w-full">
                                        <button type="submit" name="action" value="upload_image" 
                                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded text-xs transition shadow-sm uppercase">
                                            Subir esta Imagen
                                        </button>
                                    </div>
                                </div>

                                <div id="save-warning" class="hidden mt-3 p-2 bg-amber-50 border border-amber-200 rounded text-center">
                                    <p class="text-[9px] text-amber-700 font-bold uppercase flex items-center justify-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        ¡Archivo listo! Pulsa "Subir esta Imagen".
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="lg:col-span-2 bg-gray-50 p-5 rounded-lg border border-gray-300">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold text-gray-600 uppercase">Imágenes guardadas</h3>
                                <button type="button" onclick="openPreviewModal()"
                                    class="bg-blue-500 hover:bg-blue-700 text-white text-[10px] font-bold py-1.5 px-3 rounded shadow-sm transition flex items-center gap-2 uppercase">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Previsualizar PDF
                                </button>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="relative bg-white p-2 rounded border border-gray-200 shadow-sm flex flex-col">
                                        <div class="rounded overflow-hidden aspect-video bg-gray-100 mb-2">
                                            <img src="<?php echo e(asset('storage/project_steps/' . $img->file_path)); ?>"
                                                class="w-full h-full object-cover">
                                        </div>

                                        <?php
                                            $badgeColor = match ($img->fase) {
                                                'header' => 'bg-purple-100 text-purple-700 border-purple-200',
                                                'initial' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                'procedimiento' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'final' => 'bg-green-100 text-green-700 border-green-200',
                                                default => 'bg-gray-100 text-gray-600'
                                            };
                                            $label = match ($img->fase) {
                                                'header' => 'PORTADA',
                                                'initial' => 'ESTADO INICIAL',
                                                'procedimiento' => 'PASO ' . ($img->orden ?? ''),
                                                'final' => 'ESTADO FINAL',
                                                default => strtoupper($img->fase)
                                            };
                                        ?>

                                        <span class="block text-[7px] font-bold text-center py-0.5 rounded border <?php echo e($badgeColor); ?> uppercase mb-2">
                                            <?php echo e($label); ?>

                                        </span>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($img->fase !== 'header'): ?>
                                            <div class="mt-auto">
                                                <textarea name="image_descriptions[<?php echo e($img->id); ?>]" rows="3" maxlength="300"
                                                    class="w-full text-[9px] border-gray-200 rounded p-1 leading-tight focus:ring-1 focus:ring-blue-400"
                                                    placeholder="Descripción técnica..."><?php echo e($img->description); ?></textarea>
                                                
                                                <button type="button" onclick="saveImageText(this, <?php echo e($img->id); ?>)" 
                                                    class="mt-1 w-full bg-blue-500 hover:bg-blue-600 text-white text-[8px] font-bold py-1 rounded transition uppercase">
                                                    <span class="btn-text">Guardar texto</span>
                                                </button>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <button type="button"
                                            onclick="if(confirm('¿Eliminar imagen?')) document.getElementById('delete-img-<?php echo e($img->id); ?>').submit();"
                                            class="absolute -top-1.5 -right-1.5 bg-red-500 text-white rounded-full h-4 w-4 flex items-center justify-center border border-white shadow hover:bg-red-700 transition-colors">
                                            <span class="text-[10px]">&times;</span>
                                        </button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4 p-4 border rounded-lg bg-gray-50">
                    <label for="conclusion" class="block text-gray-700 font-semibold mb-2">Conclusión Final</label>
                    <textarea name="conclusion" id="conclusion" rows="4"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                        placeholder="Escribe aquí el resultado final del proyecto..."
                        maxlength="300"><?php echo e(old('conclusion', $project->conclusion)); ?></textarea>
                </div>

                <div class="mt-8 pt-6 border-t">
                    <div class="flex flex-row flex-wrap gap-3 items-center">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                            Guardar Cambios
                        </button>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->idProject): ?>
                            <a href="<?php echo e(route('project.pdf', $project->idProject)); ?>"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow text-center">
                                Ver Ficha Técnica
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <a href="javascript:history.back()"
                            class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded shadow text-center">
                            Volver
                        </a>

                        <button type="button"
                            onclick="if(confirm('¿Eliminar proyecto y asociados?')) document.getElementById('delete-project-form').submit();"
                            class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded shadow">
                            Eliminar Proyecto
                        </button>

                    </div>
                </div>
            </form>

            <div id="previewModal"
                class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-70 flex items-center justify-center p-4">
                <div class="relative bg-white w-full max-w-4xl rounded-lg shadow-2xl overflow-hidden animate-fade-in flex flex-col"
                    style="max-height: 95vh;">

                    <div class="bg-gray-100 px-6 py-4 flex justify-between items-center border-b">
                        <h2 class="text-lg font-bold text-gray-700 uppercase tracking-tight">Vista Previa de la Ficha
                            Técnica</h2>
                        <button onclick="closePreviewModal()"
                            class="text-gray-500 hover:text-red-500 text-3xl font-bold transition-colors">&times;</button>
                    </div>

                    <div class="p-8 bg-gray-200 overflow-y-auto flex-grow shadow-inner">
                        <div id="pdf-paper" class="bg-white mx-auto p-12 text-gray-900 relative shadow-2xl"
                            style="width: 210mm; min-height: 297mm; font-family: 'Helvetica', Arial, sans-serif;">

                            <div
                                class="absolute inset-0 opacity-5 pointer-events-none flex items-center justify-center p-10">
                                <img src="<?php echo e(asset('images/Curriculum CV Fondo transparente.png')); ?>" class="w-full">
                            </div>

                            <div
                                class="flex justify-between items-start mb-10 border-b-2 border-gray-100 pb-6 relative z-10">
                                <div class="w-2/3">
                                    <h1 id="modal-preview-title"
                                        class="text-3xl font-bold text-blue-800 uppercase italic leading-tight">
                                        <?php echo e($project->title); ?>

                                    </h1>
                                    <p class="text-[10px] text-gray-400 mt-2 tracking-widest uppercase">Ficha Técnica de
                                        Proyecto</p>
                                </div>
                                <div class="w-1/3 flex justify-end">
                                    <?php $portada = $project->images->where('fase', 'header')->first(); ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($portada): ?>
                                        <div
                                            class="border-4 border-white shadow-lg transform rotate-2 overflow-hidden w-40 bg-gray-100">
                                            <img src="<?php echo e(asset('storage/project_steps/' . $portada->file_path)); ?>"
                                                class="w-full h-auto object-cover">
                                        </div>
                                    <?php else: ?>
                                        <div
                                            class="w-40 h-28 border-2 border-dashed border-gray-200 flex items-center justify-center text-[10px] text-gray-300 italic text-center px-4">
                                            Sin imagen de portada seleccionada
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-8 border border-gray-100 p-4 rounded bg-blue-50 bg-opacity-30 relative z-10">
                                <h3
                                    class="text-blue-700 font-bold border-b border-blue-100 mb-2 uppercase text-[10px] tracking-widest">
                                    Resumen del Proyecto</h3>
                                <p id="modal-preview-abstract"
                                    class="text-sm text-justify leading-relaxed break-words italic">
                                    <?php echo e($project->abstract); ?>

                                </p>
                            </div>

                            <div id="modal-preview-steps" class="space-y-8 relative z-10">
                                <?php $pasos = $project->images->where('fase', 'procedimiento')->sortBy('orden')->take(3)->values(); ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $pasos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex gap-6 items-center <?php echo e($index % 2 != 0 ? 'flex-row-reverse' : ''); ?>">
                                        <div class="w-2/5 border p-1 rounded bg-white shadow-sm">
                                            <span
                                                class="text-[9px] font-bold text-blue-700 block border-b mb-1 uppercase tracking-tighter">Paso
                                                Técnico <?php echo e($img->orden ?? ($index + 1)); ?></span>
                                            <img src="<?php echo e(asset('storage/project_steps/' . $img->file_path)); ?>"
                                                class="w-full h-36 object-contain bg-gray-50">
                                        </div>
                                        <div class="w-3/5">
                                            <p class="text-[11px] text-gray-600 text-justify italic step-desc-preview"
                                                data-id="<?php echo e($img->id); ?>">
                                                <?php echo e($img->description ?? 'Sin descripción técnica...'); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <?php $final = $project->images->where('fase', 'final')->first(); ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($final): ?>
                                <div class="mt-12 pt-8 border-t-2 border-dashed border-gray-100 relative z-10">
                                    <div class="flex items-center gap-6">
                                        <div class="w-3/4">
                                            <h3
                                                class="text-green-700 font-bold uppercase text-[10px] tracking-widest mb-2 flex items-center gap-2">
                                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                                Estado final
                                            </h3>
                                            <p class="text-[11px] text-gray-500 italic step-desc-preview"
                                                data-id="<?php echo e($final->id); ?>">
                                                <?php echo e($final->description ?? 'El proyecto se ha completado según los objetivos previstos...'); ?>

                                            </p>
                                        </div>
                                        <div class="w-1/4">
                                            <img src="<?php echo e(asset('storage/project_steps/' . $final->file_path)); ?>"
                                                class="w-full border-2 border-white shadow-md rounded-sm">
                                        </div>
                                    </div>
                                    <h3 class="text-green-700 font-bold uppercase text-[10px] tracking-widest mb-2 flex items-center gap-2">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                        Conclusión final
                                    </h3>
                                    <p id="modal-preview-conclusion" class="text-[11px] text-gray-500 italic">
                                        <?php echo e($project->conclusion ?? 'El proyecto se ha completado según los objetivos previstos...'); ?>

                                    </p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>

                    <div
                        class="bg-gray-100 px-6 py-3 text-right border-t text-[10px] text-gray-400 uppercase tracking-widest font-semibold italic">
                        Simulación de documento dinámico • Generado automáticamente para revisión
                    </div>
                </div>
            </div>

            <form id="delete-project-form" action="<?php echo e(route('projects.destroy', $project->idProject)); ?>" method="POST"
                class="hidden"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
            <form id="delete-main-photo-form" action="<?php echo e(route('projects.photo.destroy', $project->idProject)); ?>"
                method="POST" class="hidden"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form id="delete-img-<?php echo e($img->id); ?>" action="<?php echo e(route('projects.image.destroy', $img->id)); ?>" method="POST"
                    class="hidden"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?></form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <script>
        // --- NUEVA FUNCIÓN: AUTO-OCULTADO DE MENSAJES ---
        document.addEventListener('DOMContentLoaded', function() {
            const feedbackMessages = document.querySelectorAll('.js-feedback-message');
            feedbackMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.transition = "opacity 0.5s ease";
                    message.style.opacity = "0";
                    setTimeout(function() {
                        message.remove();
                    }, 500);
                }, 3000); // 3 segundos visible
            });
        });

        // --- TUS FUNCIONES EXISTENTES ---
        function checkLimit(checkbox) {
            const checkedCheckboxes = document.querySelectorAll('.project-type-checkbox:checked');
            const totalChecked = checkedCheckboxes.length;

            if (totalChecked === 0) {
                checkbox.checked = true; 
                alert('Debes seleccionar al menos 1 tipo de proyecto.');
            } 
            else if (totalChecked > 3) {
                checkbox.checked = false; 
                alert('¡Máximo 3 tipos!');
            }

            const display = document.getElementById('count-display');
            if (display) {
                display.innerText = document.querySelectorAll('.project-type-checkbox:checked').length;
            }
        }

        document.addEventListener('change', function (e) {
            if (e.target && e.target.id === 'file_input_project') {
                const warning = document.getElementById('save-warning');
                if (e.target.files.length > 0) warning.classList.remove('hidden');
                else warning.classList.add('hidden');
            }
        });

        function openPreviewModal() {
            document.getElementById('modal-preview-title').innerText = document.getElementById('title').value || 'SIN TÍTULO';
            document.getElementById('modal-preview-abstract').innerText = document.getElementById('abstract').value || 'Sin descripción...';

            if(document.getElementById('modal-preview-conclusion')) {
                document.getElementById('modal-preview-conclusion').innerText = document.getElementById('conclusion').value || 'Sin conclusión...';
            }

            document.querySelectorAll('textarea[name^="image_descriptions"]').forEach(textarea => {
                const idMatch = textarea.name.match(/\[(\d+)\]/);
                if (idMatch) {
                    const id = idMatch[1];
                    const targetP = document.querySelector(`.step-desc-preview[data-id="${id}"]`);
                    if (targetP) targetP.innerText = textarea.value;
                }
            });

            const modal = document.getElementById('previewModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closePreviewModal() {
            const modal = document.getElementById('previewModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function (event) {
            const modal = document.getElementById('previewModal');
            if (event.target == modal) closePreviewModal();
        }

        function saveImageText(button, imageId) {
            const textarea = button.closest('div').querySelector('textarea');
            const text = textarea.value;
            const originalText = button.innerHTML;

            button.disabled = true;
            button.innerHTML = "Guardando...";

            fetch("<?php echo e(route('projects.update', $project->idProject)); ?>", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: 'update_text_' + imageId,
                    image_descriptions: {
                        [imageId]: text
                    },
                    _method: 'PUT' 
                })
            })
            .then(response => {
                if (response.ok) {
                    button.innerHTML = "¡Guardado!";
                    button.classList.replace('bg-blue-500', 'bg-green-500');
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.classList.replace('bg-green-500', 'bg-blue-500');
                        button.disabled = false;
                    }, 2000);
                } else {
                    alert("Error al guardar el texto.");
                    button.innerHTML = originalText;
                    button.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Error de conexión.");
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/students/myProject.blade.php ENDPATH**/ ?>