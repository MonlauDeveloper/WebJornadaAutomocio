<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Editar Proyecto</h1>

        <form action="<?php echo e(route('projects.update', $project->idProject)); ?>" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-lg">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Título del Proyecto</label>
                <input type="text" name="title" id="title" value="<?php echo e(old('title', $project->title)); ?>"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
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

            <!-- Resumen -->
            <div class="mb-4">
                <label for="abstract" class="block text-gray-700 font-semibold mb-2">Descripción</label>
                <textarea name="abstract" id="abstract" rows="4"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                    maxlength="300"><?php echo e(old('abstract', $project->abstract)); ?></textarea>
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

            <!-- Especialización -->
            <div class="mb-4">
                <label for="idSpecialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
                <select name="idSpecialization" id="idSpecialization"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($specialization->idSpecialization); ?>" <?php echo e(old('idSpecialization', $project->idSpecialization) == $specialization->idSpecialization ? 'selected' : ''); ?>>
                            <?php echo e($specialization->specialization); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['idSpecialization'];
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

            <!-- Tipo de Proyecto -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-7">
                    Tipos de Proyecto
                    <span class="text-sm text-gray-500 font-normal">(Máximo 3 opciones)</span>
                </label>

                <div class="border border-gray-300 rounded-lg p-4 bg-white max-h-60 overflow-y-auto shadow-inner">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-1">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $projectTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="flex items-center space-x-3 p-2 hover:bg-gray-50 rounded cursor-pointer transition">
                                <input type="checkbox" name="tipos[]" value="<?php echo e($type->idProjectType); ?>"
                                    class="form-checkbox h-5 w-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 project-type-checkbox"
                                    onclick="checkLimit(this)">
                                    <?php echo e($project->projectTypes && $project->projectTypes->contains('idProjectType', $type->idProjectType) ? 'checked' : ''); ?>

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

            <script>
                function checkLimit(checkbox) {
                    const checkboxes = document.querySelectorAll('.project-type-checkbox:checked');
                    const message = document.getElementById('limit-message');
                    const countDisplay = document.getElementById('count-display');
                    const count = checkboxes.length;

                    // Actualizamos el número visualmente
                    if (countDisplay) countDisplay.innerText = count;

                    if (count > 3) {
                        checkbox.checked = false;
                        if (countDisplay) countDisplay.innerText = "3";

                        message.innerHTML = "<span class='text-red-600 font-bold'>¡Máximo 3 tipos permitidos!</span>";

                        setTimeout(() => {
                            message.innerHTML = "Seleccionados: <span id='count-display'>3</span>/3";
                        }, 2000);
                    }
                }
            </script>

            <!-- Curso -->
            <div class="mb-4">
                <label for="curso" class="block text-gray-700 font-semibold mb-2">Curso</label>
                <select name="curso" id="curso"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="A" <?php echo e(old('curso', $project->curso) == 'A' ? 'selected' : ''); ?>>A</option>
                    <option value="B" <?php echo e(old('curso', $project->curso) == 'B' ? 'selected' : ''); ?>>B</option>
                    <option value="C" <?php echo e(old('curso', $project->curso) == 'C' ? 'selected' : ''); ?>>C</option>
                    <option value="D" <?php echo e(old('curso', $project->curso) == 'D' ? 'selected' : ''); ?>>D</option>
                    <option value="E" <?php echo e(old('curso', $project->curso) == 'E' ? 'selected' : ''); ?>>E</option>
                    <option value="F" <?php echo e(old('curso', $project->curso) == 'F' ? 'selected' : ''); ?>>F</option>
                    <option value="R" <?php echo e(old('curso', $project->curso) == 'R' ? 'selected' : ''); ?>>R</option>
                    <option value="ONLINE" <?php echo e(old('curso', $project->curso) == 'ONLINE' ? 'selected' : ''); ?>>ONLINE</option>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['curso'];
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

            <!-- Imagen -->
            <div class="mb-4">
                <label for="photoName" class="block text-gray-700 font-semibold mb-2">Foto del Proyecto</label>
                <input type="file" id="photoName" name="photoName"
                    class="p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->photoName): ?>
                    <p class="mt-2 text-sm text-gray-600">Archivo actual: <?php echo e($project->photoName); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Video -->
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

            <!-- PDF -->
            <!--  
            <div class="mb-4">
                <label for="pdfURL" class="block text-gray-700 font-semibold mb-2">PDF</label>
                <input type="file" name="pdfURL" id="pdfURL" class="p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->pdfURL): ?>
                    <p class="mt-2 text-sm text-red-600">PDF actual: <?php echo e($project->pdfURL); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['pdfURL'];
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
            -->

            <!-- Moodle URL -->
            <div class="mb-4">
                <label for="moodleURL" class="block text-gray-700 font-semibold mb-2">URL de Moodle</label>
                <input type="url" name="moodleURL" id="moodleURL" value="<?php echo e(old('moodleURL', $project->moodleURL)); ?>"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['moodleURL'];
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

            <!-- Ubicación -->
            <div class="mb-4">
                <label for="idUbication" class="block text-gray-700 font-semibold mb-2">Ubicación</label>
                <select name="idUbication" id="idUbication"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($ubication->idUbication); ?>" <?php echo e(old('idUbication', $project->idUbication) == $ubication->idUbication ? 'selected' : ''); ?>>
                            <?php echo e($ubication->ubicationName); ?> <!-- Aquí el cambio -->
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['idUbication'];
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

            <!-- Tribunal -->
            <div class="mb-4">
                <label for="numTribunal" class="block text-gray-700 font-semibold mb-2">Número de Tribunal</label>
                <select name="numTribunal" id="numTribunal"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="1" <?php echo e(old('numTribunal', $project->numTribunal) == '1' ? 'selected' : ''); ?>>1</option>
                    <option value="2" <?php echo e(old('numTribunal', $project->numTribunal) == '2' ? 'selected' : ''); ?>>2</option>
                    <option value="3" <?php echo e(old('numTribunal', $project->numTribunal) == '3' ? 'selected' : ''); ?>>3</option>
                    <option value="4" <?php echo e(old('numTribunal', $project->numTribunal) == '4' ? 'selected' : ''); ?>>4</option>
                    <option value="5" <?php echo e(old('numTribunal', $project->numTribunal) == '5' ? 'selected' : ''); ?>>5</option>
                    <option value="6" <?php echo e(old('numTribunal', $project->numTribunal) == '6' ? 'selected' : ''); ?>>6</option>
                    <option value="7" <?php echo e(old('numTribunal', $project->numTribunal) == '7' ? 'selected' : ''); ?>>7</option>
                    <option value="8" <?php echo e(old('numTribunal', $project->numTribunal) == '8' ? 'selected' : ''); ?>>8</option>
                    <option value="9" <?php echo e(old('numTribunal', $project->numTribunal) == '9' ? 'selected' : ''); ?>>9</option>
                    <option value="10" <?php echo e(old('numTribunal', $project->numTribunal) == '10' ? 'selected' : ''); ?>>10</option>
                    <option value="11" <?php echo e(old('numTribunal', $project->numTribunal) == '11' ? 'selected' : ''); ?>>11</option>
                    <option value="12" <?php echo e(old('numTribunal', $project->numTribunal) == '12' ? 'selected' : ''); ?>>12</option>
                    <option value="13" <?php echo e(old('numTribunal', $project->numTribunal) == '13' ? 'selected' : ''); ?>>13</option>
                    <option value="14" <?php echo e(old('numTribunal', $project->numTribunal) == '14' ? 'selected' : ''); ?>>14</option>
                    <option value="15" <?php echo e(old('numTribunal', $project->numTribunal) == '15' ? 'selected' : ''); ?>>15</option>
                    <option value="16" <?php echo e(old('numTribunal', $project->numTribunal) == '16' ? 'selected' : ''); ?>>16</option>
                    <option value="17" <?php echo e(old('numTribunal', $project->numTribunal) == '17' ? 'selected' : ''); ?>>17</option>
                    <option value="18" <?php echo e(old('numTribunal', $project->numTribunal) == '18' ? 'selected' : ''); ?>>18</option>
                    <option value="19" <?php echo e(old('numTribunal', $project->numTribunal) == '19' ? 'selected' : ''); ?>>19</option>
                    <option value="20" <?php echo e(old('numTribunal', $project->numTribunal) == '20' ? 'selected' : ''); ?>>20</option>

                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['numTribunal'];
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
                <label for="imagenProject" class="block text-gray-700 font-semibold mb-2">Subir Imagen</label>
                <div class="card p-4 bg-gray-50 rounded-lg border border-gray-300 shadow-sm sticky top-4">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 uppercase mb-3">Archivo</label>
                            <input type="file" name="new_project_image"
                                class="mt-1 block w-full text-sm file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 uppercase mt-2">Sección</label>
                                <select name="new_image_fase"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                                    <option value="header">Portada</option>
                                    <option value="initial">Estado Inicial</option>
                                    <option value="procedimiento">Procedimiento</option>
                                    <option value="final">Estado Final</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 uppercase mt-2">Orden</label>
                                <input type="number" name="new_image_orden" value="1" min="1"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1 mb-4 italic">
                        * Las imágenes aparecerán en la ficha técnica del PDF tras pulsar "Guardar Cambios" *.
                    </p>
                    <div class="p-4 bg-white rounded-lg border border-gray-300 shadow-sm flex flex-col">
                        <div class="flex items-center justify-between mb-3 border-b pb-2">
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Imágenes Actuales</h3>
                            <span
                                class="text-[10px] bg-gray-100 px-2 py-0.5 rounded-full text-gray-500"><?php echo e($project->images->count()); ?>

                                archivos</span>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-8">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative group border rounded-lg p-1 bg-white shadow-sm flex flex-col">
                                    <div class="overflow-hidden rounded-md bg-gray-50 h-32 ">
                                        <img src="<?php echo e(asset('storage/project_steps/' . $img->file_path)); ?>"
                                            class="h-auto w-60 object-cover transition-transform duration-300 group-hover:scale-110">
                                    </div>

                                    <div class="mt-1.5">
                                        <?php
                                            $color = match ($img->fase) {
                                                'header' => 'bg-purple-100 text-purple-700',
                                                'initial' => 'bg-amber-100 text-amber-700',
                                                'procedimiento' => 'bg-blue-100 text-blue-700',
                                                'final' => 'bg-green-100 text-green-700',
                                                default => 'bg-gray-100 text-gray-700'
                                            };
                                            $nombreFase = match ($img->fase) {
                                                'header' => 'PORTADA',
                                                'initial' => 'INICIAL',
                                                'procedimiento' => 'PASO ' . ($img->orden ?? ''),
                                                'final' => 'FINAL',
                                                default => $img->fase
                                            };
                                        ?>
                                        <span
                                            class="block text-[7px] font-black text-center py-0.5 rounded <?php echo e($color); ?> uppercase">
                                            <?php echo e($nombreFase); ?>

                                        </span>
                                    </div>

                                    <button type="button"
                                        onclick="if(confirm('¿Eliminar esta imagen?')) document.getElementById('delete-img-<?php echo e($img->id); ?>').submit();"
                                        class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full h-5 w-5 flex items-center justify-center hover:bg-red-800 shadow-md border-2 border-white transition-all scale-0 group-hover:scale-100">
                                        <span class="text-[10px]">&times;</span>
                                    </button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($project->images->isEmpty()): ?>
                                <p class="text-[11px] text-gray-400 italic text-center py-4">No hay imágenes cargadas.</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Botón de enviar -->
                <div class="mt-8 flex flex-row gap-4 pt-6">
            
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition">
                Guardar Cambios
            </button>

            <button type="button" 
                onclick="if(confirm('Si eliminas el proyecto también eliminarás a los estudiantes asociados. ¿Estás seguro?')) document.getElementById('delete-project-form').submit();" 
                class="bg-red-800 hover:bg-red-900 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition">
                Eliminar Proyecto
            </button>

            <a href="javascript:history.back()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2.5 px-6 rounded-lg shadow-sm transition text-center">
                Volver Atrás
            </a>
        </div>

    </form>

    
    <form id="delete-project-form" action="<?php echo e(route('projects.destroy', $project->idProject)); ?>" method="POST" class="hidden">
        <?php echo csrf_field(); ?>
        <?php echo method_field('DELETE'); ?>
    </form>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $project->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <form id="delete-img-<?php echo e($img->id); ?>" action="<?php echo e(route('projects.image.destroy', $img->id)); ?>" method="POST" class="hidden">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
        </form>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/projects/edit.blade.php ENDPATH**/ ?>