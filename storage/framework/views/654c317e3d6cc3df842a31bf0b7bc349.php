

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Mi Perfil</h1>

        <!-- Foto y Nombre -->
        <div class="text-center mt-6">
            <img class="w-32 h-32 object-cover rounded-full mx-auto" 
                 src="<?php echo e(asset('storage/photos/' . $student->photoName)); ?>" 
                 alt="<?php echo e($student->name); ?>">
            <h2 class="text-2xl font-semibold text-gray-800 mt-4">
                <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

            </h2>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Configuración contraseña -->
        <div class="mt-8">
            <h2 class="text-3xl font-semibold text-blue-600">Configura tu Contraseña</h2>
            <form action="<?php echo e(route('students.updatePassword')); ?>" method="POST" class="space-y-6 mt-4">
                <?php echo csrf_field(); ?>

                <?php if(session('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <?php echo e(session('error')); ?>

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

                <!-- Contraseña actual -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-600">Contraseña Actual</label>
                    <input type="password" name="current_password" id="current_password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           required>
                </div>

                <!-- Nueva Contraseña -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-600">Nueva Contraseña</label>
                    <input type="password" name="new_password" id="new_password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           required>
                </div>

                <!-- Confirmar Nueva Contraseña -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-600">Confirmar Nueva Contraseña</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                           required>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                    Cambiar Contraseña
                </button>
            </form>
        </div>
                
        <!-- Configuración del Currículum -->
        <div class="mt-8">
            <h2 class="text-3xl font-semibold text-blue-600">Configura tu Curriculum</h2>
            <form action="<?php echo e(route('students.updateProfile')); ?>" method="POST" class="space-y-6 mt-4">
                <?php echo csrf_field(); ?>

                <!-- Introducción -->
                <div>
                    <label for="introduction" class="block text-sm font-medium text-gray-600">Introducción</label>
                    <textarea id="introduction" name="introduction" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                              rows="3"><?php echo e(old('introduction', $student->introduction)); ?></textarea>
                </div>

                <!-- Educación -->
                <div>
                    <label for="education" class="block text-sm font-medium text-gray-600">Educación</label>
                    <div id="education-container" class="space-y-2">
                        <?php $__currentLoopData = $student->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center">
                                <input type="text" name="education[]" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                                       value="<?php echo e($education->education); ?>" placeholder="Añadir educación">
                                <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                    ✖
                                </button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" id="add-education" 
                            class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar más estudios</button>
                </div>

                <!-- Idiomas -->
                <div>
                    <label for="languages" class="block text-sm font-medium text-gray-600">Idiomas</label>
                    <div id="languages-container" class="space-y-2">
                        <?php $__currentLoopData = $student->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center">
                                <input type="text" name="languages[]" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                                       value="<?php echo e($language->language); ?>" placeholder="Añadir idioma">
                                <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                    ✖
                                </button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" id="add-language" 
                            class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar más idiomas</button>
                </div>

                <!-- Experiencia Laboral -->
                <div>
                    <label for="work_experience" class="block text-sm font-medium text-gray-600">Experiencia Laboral</label>
                    <div id="experience-container" class="space-y-2">
                        <?php $__currentLoopData = $student->workExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center">
                                <input type="text" name="work_experience[]" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                                       value="<?php echo e($experience->work_experience); ?>" placeholder="Añadir experiencia">
                                <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                    ✖
                                </button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" id="add-experience" 
                            class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar más experiencia</button>
                </div>

                <!-- Contacto -->
                <div>
                    <label for="contact" class="block text-sm font-medium text-gray-600">Contacto</label>
                    <div id="contact-container" class="space-y-2">
                        <?php $__currentLoopData = $student->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center">
                                <input type="text" name="contact[]" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                                       value="<?php echo e($contact->contact); ?>" placeholder="Añadir contacto">
                                <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                    ✖
                                </button>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <button type="button" id="add-contact" 
                            class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar más contacto</button>
                </div>

                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                    Guardar Cambios
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Función para agregar dinámicamente más campos de entrada
    function addInput(containerId, inputName) {
        const container = document.getElementById(containerId);
        
        let placeholderText = '';
        if (inputName === 'education') placeholderText = 'Añadir educación';
        if (inputName === 'languages') placeholderText = 'Añadir idioma';
        if (inputName === 'work_experience') placeholderText = 'Añadir experiencia';
        if (inputName === 'contact') placeholderText = 'Añadir contacto';

        const inputGroup = document.createElement('div');
        inputGroup.className = 'flex items-center mt-2';
        inputGroup.innerHTML = `
            <input type="text" name="${inputName}[]" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                placeholder="${placeholderText}">
            <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">✖</button>
        `;
        container.appendChild(inputGroup);
    }

    document.getElementById('add-education').addEventListener('click', () => addInput('education-container', 'education'));
    document.getElementById('add-language').addEventListener('click', () => addInput('languages-container', 'languages'));
    document.getElementById('add-experience').addEventListener('click', () => addInput('experience-container', 'work_experience'));
    document.getElementById('add-contact').addEventListener('click', () => addInput('contact-container', 'contact'));

    // Listener para eliminar campos de entrada
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-input')) {
            e.target.parentElement.remove();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/students/myProfile.blade.php ENDPATH**/ ?>