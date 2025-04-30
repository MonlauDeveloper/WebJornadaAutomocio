<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-blue-600 text-center">Inicio</h1>

        <!-- Main Section -->
        <main>
            <!-- Hero Section -->
            <section class="bg-blue-100 text-center py-24 px-6 rounded-lg shadow-xl mt-4">
                <h1 class="text-4xl font-semibold text-blue-800 mb-4 animate__animated animate__fadeIn">Bienvenidos al Colegio Monlau</h1>
                <p class="text-lg text-blue-600 mb-6 animate__animated animate__fadeIn animate__delay-1s">Formación profesional de calidad para tu futuro.</p>
                <a href="#about" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 animate__animated animate__fadeIn animate__delay-2s">Descubre más</a>
            </section>

            <!-- About Section (example) -->
            <section id="about" class="py-24 bg-white text-center">
                <h2 class="text-3xl font-semibold text-blue-800 mb-4">¿Por qué elegirnos?</h2>
                <p class="text-lg text-gray-600 max-w-4xl mx-auto mb-6">En Monlau, nos dedicamos a proporcionar una educación práctica y moderna, adaptada a las necesidades del mercado laboral actual, preparándote para afrontar cualquier reto en tu carrera profesional.</p>
                <a href="#contact" class="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Contáctanos</a>
            </section>
        </main>
       
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\practicas FCT monlau\web1\web1Prueba\web1Prueba\resources\views/dashboard.blade.php ENDPATH**/ ?>