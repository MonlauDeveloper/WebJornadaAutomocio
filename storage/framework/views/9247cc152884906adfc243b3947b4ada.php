<!DOCTYPE html>

<html>

<head>

    <title>How to Convert an Image to webp in Laravel? - ItSolutionStuff.com</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    

<div class="container">

    <h1>How to Convert an Image to webp in Laravel? - ItSolutionStuff.com</h1>

    <?php if(count($errors) > 0): ?>

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <li><?php echo e($error); ?></li>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>

        </div>

    <?php endif; ?>

           

    <?php if($message = Session::get('success')): ?>

      

    <div class="alert alert-success alert-dismissible fade show" role="alert">

      <strong><?php echo e($message); ?></strong>

      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

  

    <div class="row">

        <div class="col-md-4">

            <strong>Original Image:</strong>

            <br/>

            <img src="/images/<?php echo e(Session::get('imageName')); ?>" width="300px" />

        </div>

    </div>

    <?php endif; ?>

            

    <form action="<?php echo e(route('image.store')); ?>" method="post" enctype="multipart/form-data">

        <?php echo csrf_field(); ?>

        <div class="row">

            <div class="col-md-12">

                <br/>

                <input type="file" name="image" class="image">

            </div>

            <div class="col-md-12">

                <br/>

                <button type="submit" class="btn btn-success">Upload Image</button>

            </div>

        </div>

    </form>

</div>

    

</body>

</html><?php /**PATH H:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/imageUpload.blade.php ENDPATH**/ ?>