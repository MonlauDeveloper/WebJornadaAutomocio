<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-blue-600 text-center">Mi Perfil</h1>

            <!-- Foto y Nombre -->
            <div class="text-center mt-6">
                <img class="w-32 h-32 object-cover object-top rounded-full mx-auto"
                    src="<?php echo e(asset('storage/' . $student->photoName)); ?>" alt="<?php echo e($student->name); ?>" onerror="this.onerror=null; this.src='https://jornadaautomocion.alumnes-monlau.com/storage/photos/por_defecto/user_default.png';">
                <h2 class="text-2xl font-semibold text-gray-800 mt-4">
                    <?php echo e($student->name); ?> <?php echo e($student->surname1); ?> <?php echo e($student->surname2); ?>

                </h2>
            </div>

            
            <!-- Mostrar mensajes de éxito o error -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4 mb-4">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Configuración contraseña -->
            <div class="mt-8">
                <h2 class="text-3xl font-semibold text-blue-600">Configura tu Contraseña</h2>
                <form action="<?php echo e(route('students.updatePassword')); ?>" method="POST" class="space-y-6 mt-4">
                    <?php echo csrf_field(); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <?php echo e(session('error')); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul class="list-disc pl-5">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <!-- Contraseña actual -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-600">Contraseña
                            Actual</label>
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
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-600">Confirmar
                            Nueva Contraseña</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg transition">
                        Cambiar Contraseña
                    </button>
                </form>
            </div>

            <!-- Configuración del Currículum -->
            <div class="mt-8 mb-4">
                <h2 class="text-3xl font-semibold text-blue-600">Configura tu Currículum</h2>
                <form action="<?php echo e(route('students.updateProfile')); ?>" method="POST" class="space-y-6 mt-4">
                    <?php echo csrf_field(); ?>

                    <!-- Introducción -->
                    <div>
                        <label for="introduction" class="block text-sm font-medium text-gray-600">Sobre mí (Máx. 300 caracteres)</label>
                        <textarea id="introduction" name="introduction"
                            maxlength="300"
                            placeholder="Escribe aquí una breve descripción personal (intereses, experiencia, objetivos)…"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            rows="3"><?php echo e(old('introduction', $student->introduction)); ?></textarea>
                    </div>
                    
                    <!-- Contacto -->
                    <div>
                        <label for="contact" class="block text-sm font-medium text-gray-600">Contacto</label>
                        <div id="contact-container" class="space-y-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $student->contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center">
                                    <input type="text" name="contact[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        value="<?php echo e($contact->contact); ?>" placeholder="Añadir contacto">
                                    <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                        ✖
                                    </button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <button type="button" id="add-contact" class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar más
                            contacto</button>
                    </div>

                    <!-- Codigo postal y Poblacion -->
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="postal_code" class="block text-sm font-semibold text-gray-600 mb-1">Código Postal</label>
                            <input type="text" name="postal_code" id="postal_code"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition shadow-sm"
                                value="<?php echo e(old('postal_code', $student->postal_code)); ?>" placeholder="Ej: 08020">
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-600 mb-1">Población</label>
                            <input type="text" name="city" id="city"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition shadow-sm"
                                value="<?php echo e(old('city', $student->city)); ?>" placeholder="Ej: Barcelona">
                        </div>
                    </div>

                    <!-- Educación -->
                    <div>
                        <label for="education" class="block text-sm font-medium text-gray-600">Formación</label>
                        <div id="education-container" class="space-y-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $student->educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center">
                                    <input type="text" name="education[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        value="<?php echo e($education->education); ?>" placeholder="Añadir Formación">
                                    <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                        ✖
                                    </button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <button type="button" id="add-education" class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar
                            más estudios</button>
                    </div>
                    
                    <!-- Experiencia Laboral -->
                    <div>
                        <label for="work_experience" class="block text-sm font-medium text-gray-600">Experiencia
                            Laboral</label>
                        <div id="experience-container" class="space-y-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $student->workExperiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center">
                                    <input type="text" name="work_experience[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        value="<?php echo e($experience->work_experience); ?>"
                                        placeholder="Añadir experiencia (Fecha Inicio - Fecha Fin) (Nombre Empresa) (Función Desarrollada)">
                                    <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                        ✖
                                    </button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <button type="button" id="add-experience" class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar
                            más experiencia</button>
                    </div>

                    <!-- Linkedin -->
                    <div class="mb-4 space-y-1">
                        <label for="linkedin" class="block text-sm font-bold text-gray-700 ml-1">Perfil de LinkedIn</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fab fa-linkedin text-blue-600 text-lg group-focus-within:text-blue-700"></i>
                            </div>
                            <input type="url" name="linkedin" id="linkedin"
                                class="block w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm shadow-sm
                                placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                transition duration-200"
                                placeholder="https://www.linkedin.com/in/tu-usuario"
                                value="<?php echo e(old('linkedin', $student->Linkedin ?? '')); ?>">
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['linkedin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-xs text-red-500 font-medium">
                                <i class="fas fa-times-circle mr-1"></i> <?php echo e($message); ?>

                            </p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Idiomas -->
                    <div>
                        <label for="languages" class="block text-sm font-medium text-gray-600">Idiomas</label>
                        <div id="languages-container" class="space-y-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $student->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center">
                                    <input type="text" name="languages[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        value="<?php echo e($language->language); ?>" placeholder="Añadir idioma">
                                    <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">
                                        ✖
                                    </button>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <button type="button" id="add-language" class="mt-2 text-blue-500 hover:text-blue-700">+ Agregar más
                            idiomas</button>
                    </div>
                    
                    <!-- Aviso legal -->
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                        <p class="font-bold">Aviso Importante</p>
                        <p>Los datos que introduzcas en este formulario serán públicos y se mostrarán a las empresas.
                            Asegúrate de no incluir información sensible o privada.</p>
                    </div>

                    <button type="submit"
                        class="mb-4 w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transition">
                        Guardar Cambios
                    </button>
                </form>
            </div>
            <a href="<?php echo e(route('students.descargar', $student->idStudent)); ?>"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transition">Ver
                Currículum</a>

        </div>
    </div>

    <script>
        // Función para agregar dinámicamente más campos de entrada
        function addInput(containerId, inputName) {
            const container = document.getElementById(containerId);

            if (containerId === 'contact-container') {
                const currentContacts = container.querySelectorAll('input').length;
                if (currentContacts >= 2) {
                    alert('Solo puedes añadir un máximo de 2 contactos.');
                    return;
                }
            }

            let placeholderText = '';
            if (inputName === 'education') placeholderText = 'Añadir Formación (Fecha Inicio - Fecha Fin) (Nivel de Estudios) (Nombre Escuela)';
            if (inputName === 'languages') placeholderText = 'Añadir idioma (Idioma - Nivel)';
            if (inputName === 'work_experience') placeholderText = 'Añadir experiencia (Fecha Inicio - Fecha Fin) (Nombre Empresa) (Función Desarrollada)';
            if (inputName === 'contact') placeholderText = 'Añadir contacto (juanjo@gmail.com)';

            const inputGroup = document.createElement('div');
            inputGroup.className = 'flex items-center mt-2';
            inputGroup.innerHTML = `
                <input type="text" name="${inputName}[]" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                    placeholder="${placeholderText}">
                <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-input">✖</button>
            `;
            container.appendChild(inputGroup);
            
            if (containerId === 'contact-container') {
                updateContactButtonVisibility();
            }
        }

        function updateContactButtonVisibility() {
            const container = document.getElementById('contact-container');
            const button = document.getElementById('add-contact');
            if (container && button) {
                const currentContacts = container.querySelectorAll('input').length;
                if (currentContacts >= 2) {
                    button.style.display = 'none';
                } else {
                    button.style.display = 'inline-block';
                }
            }
        }

        document.getElementById('add-education').addEventListener('click', () => addInput('education-container', 'education'));
        document.getElementById('add-language').addEventListener('click', () => addInput('languages-container', 'languages'));
        document.getElementById('add-experience').addEventListener('click', () => addInput('experience-container', 'work_experience'));
        document.getElementById('add-contact').addEventListener('click', () => addInput('contact-container', 'contact'));

        // Listener para eliminar campos de entrada
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-input')) {
                e.target.parentElement.remove();
                updateContactButtonVisibility();
            }
        });

        // Comprobar on load
        document.addEventListener('DOMContentLoaded', () => {
            updateContactButtonVisibility();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/students/myProfile.blade.php ENDPATH**/ ?>