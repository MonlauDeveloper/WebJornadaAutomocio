<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-8">Editar Proyecto</h1>

    <form action="<?php echo e(route('projects.update', $project->idProject)); ?>" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Título -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-2">Título del Proyecto</label>
            <input type="text" name="title" id="title" value="<?php echo e(old('title', $project->title)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Resumen -->
        <div class="mb-4">
            <label for="abstract" class="block text-gray-700 font-semibold mb-2">Descripción</label>
            <textarea name="abstract" id="abstract" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200" maxlength="300"><?php echo e(old('abstract', $project->abstract)); ?></textarea>
            <p class="text-gray-500 text-xs mt-1">Máximo 300 caracteres</p>
            <?php $__errorArgs = ['abstract'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Especialización -->
        <div class="mb-4">
            <label for="idSpecialization" class="block text-gray-700 font-semibold mb-2">Especialización</label>
            <select name="idSpecialization" id="idSpecialization" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__currentLoopData = $specializations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $specialization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($specialization->idSpecialization); ?>" <?php echo e(old('idSpecialization', $project->idSpecialization) == $specialization->idSpecialization ? 'selected' : ''); ?>>
                        <?php echo e($specialization->specialization); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['idSpecialization'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Curso -->
        <div class="mb-4">
            <label for="curso" class="block text-gray-700 font-semibold mb-2">Curso</label>
            <select name="curso" id="curso" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="A" <?php echo e(old('curso', $project->curso) == 'A' ? 'selected' : ''); ?>>A</option>           
                <option value="B" <?php echo e(old('curso', $project->curso) == 'B' ? 'selected' : ''); ?>>B</option>           
                <option value="C" <?php echo e(old('curso', $project->curso) == 'C' ? 'selected' : ''); ?>>C</option>           
                <option value="D" <?php echo e(old('curso', $project->curso) == 'D' ? 'selected' : ''); ?>>D</option>           
                <option value="E" <?php echo e(old('curso', $project->curso) == 'E' ? 'selected' : ''); ?>>E</option>           
                <option value="F" <?php echo e(old('curso', $project->curso) == 'F' ? 'selected' : ''); ?>>F</option>           
                <option value="R" <?php echo e(old('curso', $project->curso) == 'R' ? 'selected' : ''); ?>>R</option>           
                <option value="ONLINE" <?php echo e(old('curso', $project->curso) == 'ONLINE' ? 'selected' : ''); ?>>ONLINE</option>  
            </select>       
            <?php $__errorArgs = ['curso'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Imagen -->
        <div class="mb-4">
            <label for="photoName" class="block text-gray-700 font-semibold mb-2">Foto del Proyecto</label>
            <input type="file" id="photoName" name="photoName" class="p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php if($project->photoName): ?>
                <p class="mt-2 text-sm text-gray-600">Archivo actual: <?php echo e($project->photoName); ?></p>
            <?php endif; ?>
        </div>

        <!-- Video -->
        <div class="mb-4">
            <label for="videoURL" class="block text-gray-700 font-semibold mb-2">Vídeo URL</label>
            <input type="text" name="videoURL" id="videoURL" value="<?php echo e(old('videoURL', $project->videoURL)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['videoURL'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- PDF -->
        <div class="mb-4">
            <label for="pdfURL" class="block text-gray-700 font-semibold mb-2">PDF</label>
            <input type="file" name="pdfURL" id="pdfURL" class="p-3 w-full rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php if($project->pdfURL): ?>
                <p class="mt-2 text-sm text-gray-600">PDF actual: <?php echo e($project->pdfURL); ?></p>
            <?php endif; ?>
            <?php $__errorArgs = ['pdfURL'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Moodle URL -->
        <div class="mb-4">
            <label for="moodleURL" class="block text-gray-700 font-semibold mb-2">URL de Moodle</label>
            <input type="url" name="moodleURL" id="moodleURL" value="<?php echo e(old('moodleURL', $project->moodleURL)); ?>" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
            <?php $__errorArgs = ['moodleURL'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Ubicación -->        
        <div class="mb-4">
            <label for="idUbication" class="block text-gray-700 font-semibold mb-2">Ubicación</label>
            <select name="idUbication" id="idUbication" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <?php $__currentLoopData = $ubications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($ubication->idUbication); ?>" 
                        <?php echo e(old('idUbication', $project->idUbication) == $ubication->idUbication ? 'selected' : ''); ?>>
                        <?php echo e($ubication->ubicationName); ?> <!-- Aquí el cambio -->
                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['idUbication'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Tribunal -->        
        <div class="mb-4">
            <label for="numTribunal" class="block text-gray-700 font-semibold mb-2">Número de Tribunal</label>
            <select name="numTribunal" id="numTribunal" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
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
            <?php $__errorArgs = ['numTribunal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>


        <!-- Botón de enviar -->
        <div class="mt-6">
            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 py-2.5 px-4 rounded-lg">Guardar Cambios</button>
    </form>
            <form action="<?php echo e(route('projects.destroy', $project->idProject)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="mt-2 mb-4 text-white bg-red-800 hover:bg-red-900 py-2.5 px-4 rounded-lg" onclick="return confirm('Si eliminas el proyecto también eliminarás a los estudiantes asociados. ¿Estás seguro?');">Eliminar</button>
            </form>
            <a href="javascript:history.back()" class="mt-2 text-white bg-gray-600 hover:bg-gray-700 py-3 px-6 rounded-lg">Volver Atrás</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/vhosts/alumnes-monlau.com/jornadaautomocion.alumnes-monlau.com/resources/views/projects/edit.blade.php ENDPATH**/ ?>