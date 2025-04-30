<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
    <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div> 

    <div class="flex items-center justify-center h-full relative z-10">
        <div class="bg-white bg-opacity-80 p-8 rounded-lg shadow-lg w-full max-w-md max-h-[80vh] overflow-y-auto">
            <img src="<?php echo e(asset('images/logoMonlau.png')); ?>" alt="Logo" class="mx-auto w-40 mb-2">

            <form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>

                <h2 class="text-2xl font-bold text-center text-gray-800">Crear cuenta de Empresa</h2>

                <!-- Campo Nombre de Empresa -->
                <div class="space-y-2">
                    <label for="company_name" class="block text-sm font-medium text-gray-600">Nombre de Empresa</label>
                    <input 
                        type="text" 
                        id="company_name" 
                        name="companyName" 
                        value="<?php echo e(old('company_name')); ?>" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa el nombre de tu empresa"
                        required autofocus autocomplete="organization">
                </div>

                <!-- Campo NIF/CIF/RFC -->
                <div class="space-y-2">
                    <label for="tax_id" class="block text-sm font-medium text-gray-600">NIF/CIF/RFC</label>
                    <input 
                        type="text" 
                        id="tax_id" 
                        name="idenFis" 
                        value="<?php echo e(old('tax_id')); ?>" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa el NIF/CIF/RFC"
                        required autocomplete="off">
                </div>

                <!-- Campo Nombre del Representante Legal o Contacto Principal -->
                <div class="space-y-2">
                    <label for="representative_name" class="block text-sm font-medium text-gray-600">Nombre del Representante Legal</label>
                    <input 
                        type="text" 
                        id="representative_name" 
                        name="representanteLegal" 
                        value="<?php echo e(old('representative_name')); ?>" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa el nombre del representante"
                        required autocomplete="name">
                </div>

                <!-- Campo Teléfono del Representante -->
                <div class="space-y-2">
                    <label for="representative_phone" class="block text-sm font-medium text-gray-600">Teléfono del Representante</label>
                    <input 
                        type="tel" 
                        id="representative_phone" 
                        name="telefonoRepresentante" 
                        value="<?php echo e(old('representative_phone')); ?>" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa el teléfono del representante"
                        required autocomplete="tel">
                </div>

                <!-- Campo Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="<?php echo e(old('email')); ?>" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                        placeholder="Ingresa tu correo electrónico"
                        required autocomplete="email">
                </div>

                <!-- Campo Contraseña -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-gray-600">Contraseña</label>
                    <div class="relative">
                        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'password','class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none','type' => 'password','name' => 'password','placeholder' => 'Ingresa tu contraseña','required' => true,'autocomplete' => 'new-password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'password','class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none','type' => 'password','name' => 'password','placeholder' => 'Ingresa tu contraseña','required' => true,'autocomplete' => 'new-password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                        <span 
                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer"
                            onclick="togglePassword('password', 'eyeIcon1')">
                            <i id="eyeIcon1" class="fas fa-eye-slash"></i> 
                        </span>
                    </div>
                </div>

                <!-- Campo Confirmar Contraseña -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirmar Contraseña</label>
                    <div class="relative">
                        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'password','id' => 'password_confirmation','name' => 'password_confirmation','class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none','placeholder' => 'Repite tu contraseña','required' => true,'autocomplete' => 'new-password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','id' => 'password_confirmation','name' => 'password_confirmation','class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none','placeholder' => 'Repite tu contraseña','required' => true,'autocomplete' => 'new-password']); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                        <span 
                            class="absolute inset-y-0 right-4 flex items-center text-gray-500 cursor-pointer"
                            onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                            <i id="eyeIcon2" class="fas fa-eye-slash"></i> 
                        </span>
                    </div>
                </div>

                <!-- Términos y condiciones -->
                <?php if(Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature()): ?>
                <div class="space-y-2">
                    <label for="terms" class="flex items-center">
                        <input type="checkbox" name="terms" id="terms" required class="mr-2">
                        <span class="text-sm text-gray-600">
                            Acepto los 
                            <a href="<?php echo e(route('terms.show')); ?>" target="_blank" class="text-blue-500 hover:underline">Términos de Servicio</a> y la 
                            <a href="<?php echo e(route('policy.show')); ?>" target="_blank" class="text-blue-500 hover:underline">Política de Privacidad</a>.
                        </span>
                    </label>
                </div>
                <?php endif; ?>

                <?php if (isset($component)) { $__componentOriginalb24df6adf99a77ed35057e476f61e153 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb24df6adf99a77ed35057e476f61e153 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation-errors','data' => ['class' => 'mb-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb24df6adf99a77ed35057e476f61e153)): ?>
<?php $attributes = $__attributesOriginalb24df6adf99a77ed35057e476f61e153; ?>
<?php unset($__attributesOriginalb24df6adf99a77ed35057e476f61e153); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb24df6adf99a77ed35057e476f61e153)): ?>
<?php $component = $__componentOriginalb24df6adf99a77ed35057e476f61e153; ?>
<?php unset($__componentOriginalb24df6adf99a77ed35057e476f61e153); ?>
<?php endif; ?>

                <!-- Botón de Registro -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition">
                    Registrarse
                </button>

                <!-- Enlace a Login -->
                <p class="text-sm text-center text-gray-600">
                    ¿Ya tienes una cuenta? 
                    <a href="<?php echo e(route('login')); ?>" class="text-blue-500 hover:underline">Iniciar sesión</a>
                </p>
                <p class="text-sm text-center text-gray-600">
                    <a href="<?php echo e(route('register')); ?>" class="text-blue-500 hover:underline">Crear cuenta de usuario</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(passwordId, eyeIconId) {
            const passwordInput = document.getElementById(passwordId);
            const eyeIcon = document.getElementById(eyeIconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>
<?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/auth/registerEmpresa.blade.php ENDPATH**/ ?>