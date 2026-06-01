<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favi2020.png')); ?>">
</head>

<body class="h-screen bg-cover bg-center relative" style="background-image: url('/images/imagenFondo.webp')">
    <div class="absolute inset-0 bg-blue-500 bg-opacity-50"></div>

    <div class="flex items-center justify-center h-full relative z-10 px-4">
        <div class="bg-white bg-opacity-95 p-6 md:p-8 rounded-[2rem] shadow-lg w-full max-w-[420px] transition-all">

            <div class="flex justify-center mb-4">
                <img src="<?php echo e(asset('images/logoMonlau2026(2).png')); ?>" alt="Logo"
                    class="w-full max-w-[220px] h-auto object-contain">
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" onsubmit="comprobarUsuario()" class="space-y-4">
                <?php echo csrf_field(); ?>
                <h2 class="text-xl font-bold text-center text-gray-800">Iniciar sesión</h2>

                <div class="space-y-3">
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-semibold text-gray-600 ml-4">Usuario / Email</label>
                        <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'email','class' => 'w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm','type' => 'text','name' => 'email','value' => old('email'),'placeholder' => 'Nombre de empresa o email','required' => true,'autofocus' => true,'autocomplete' => 'username']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'email','class' => 'w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm','type' => 'text','name' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('email')),'placeholder' => 'Nombre de empresa o email','required' => true,'autofocus' => true,'autocomplete' => 'username']); ?>
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
                    </div>

                    <div class="space-y-1">
                        <label for="password" class="block text-xs font-semibold text-gray-600 ml-4">Contraseña</label>
                        <div class="relative">
                            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'password','class' => 'w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm','type' => 'password','name' => 'password','placeholder' => 'Introduce tu contraseña','required' => true,'autocomplete' => 'current-password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'password','class' => 'w-full px-4 py-2.5 border border-gray-300 rounded-full focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all text-sm','type' => 'password','name' => 'password','placeholder' => 'Introduce tu contraseña','required' => true,'autocomplete' => 'current-password']); ?>
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
                            <span class="absolute inset-y-0 right-5 flex items-center text-gray-500 cursor-pointer"
                                onclick="togglePassword()">
                                <i id="eyeIcon" class="fas fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between text-[11px] px-2">
                    <label class="flex items-center space-x-1 cursor-pointer">
                        <?php if (isset($component)) { $__componentOriginal74b62b190a03153f11871f645315f4de = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal74b62b190a03153f11871f645315f4de = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.checkbox','data' => ['id' => 'remember_me','name' => 'remember','class' => 'text-blue-500 rounded scale-90']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'remember_me','name' => 'remember','class' => 'text-blue-500 rounded scale-90']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $attributes = $__attributesOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__attributesOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal74b62b190a03153f11871f645315f4de)): ?>
<?php $component = $__componentOriginal74b62b190a03153f11871f645315f4de; ?>
<?php unset($__componentOriginal74b62b190a03153f11871f645315f4de); ?>
<?php endif; ?>
                        <span>Recordarme</span>
                    </label>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="text-blue-500 hover:underline">
                            ¿Olvidaste tu contraseña?
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if (isset($component)) { $__componentOriginalb24df6adf99a77ed35057e476f61e153 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb24df6adf99a77ed35057e476f61e153 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.validation-errors','data' => ['class' => 'mb-1']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-1']); ?>
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

                <div class="pt-1 space-y-2">
                    <button type="submit"
                        class="w-full bg-[#0051bb] hover:bg-[#004199] text-white font-bold py-2.5 rounded-full transition-all active:scale-[0.98] shadow-md uppercase text-[10px] tracking-widest">
                        Login
                    </button>

                    <button type="button" onclick="window.location.href='<?php echo e(route('microsoft.login')); ?>'"
                        class="w-full bg-[#007ed3] hover:bg-[#006bb3] border border-gray-300 text-white font-bold py-2.5 rounded-full transition-all active:scale-[0.98] shadow-md flex items-center justify-center space-x-2 uppercase text-[10px] tracking-widest">
                        <div class="bg-white p-0.5 rounded-sm flex items-center justify-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg"
                                alt="Microsoft Logo" class="w-3.5 h-3.5">
                        </div>
                        <span>Iniciar sesión con Microsoft</span>
                    </button>
                </div>

                <p class="text-[11px] text-center text-gray-500 pt-1">
                    ¿No tienes una cuenta?
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('register')): ?>
                        <a href="<?php echo e(route('register')); ?>" class="text-blue-500 hover:underline font-bold">Regístrate</a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </p>
            </form>
        </div>
    </div>

    <script>
        function comprobarUsuario() {
    const inputUsuario = document.getElementById('email');
    if (inputUsuario.value) {
        let valor = inputUsuario.value.trim();
        
        if (!valor.includes('@')) {
            valor = valor.replace(/[\s\-_&]/g, '');
            inputUsuario.value = valor + '@empresa.com';
        }
    }
}

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>

</html><?php /**PATH /var/www/jornada-automocion-api/resources/views/auth/login.blade.php ENDPATH**/ ?>