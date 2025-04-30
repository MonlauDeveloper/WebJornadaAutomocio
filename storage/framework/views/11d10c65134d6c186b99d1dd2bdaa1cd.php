<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Monlau</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="<?php echo e(asset('images/favi2020.png')); ?>">

        <!-- Styles / Scripts -->
        <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
            <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <?php endif; ?>
    </head>
    <body class="font-sans antialiased bg-gradient-to-r from-blue-50 to-white text-gray-700">
        <div class="container">
            <div class="row">
                <div>
                    
                    <div>
                        <?php if(Session::has('success')): ?>
                            <div>
                                <?php echo e(Session::get('success')); ?>

                            </div>
                        <?php elseif(Session::has('error')): ?>
                            <div>
                                <?php echo e(Session::get('error')); ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="<?php echo e(route('image.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div>
                            <div>
                                <h4>Image Intervention in Laravel 11</h4>
                            </div>
                            <div>
                                <div>
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image"/>

                                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p> <?php echo e($message); ?> </p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>  
                            <div>
                                <button type="submit">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/image-upload.blade.php ENDPATH**/ ?>