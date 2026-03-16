<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-4 md:p-6">
        <div class="bg-white p-4 md:p-8 rounded-lg shadow-lg max-w-4xl mx-auto">

            <main class="text-center">
                <section class="px-2 md:px-6">
                    <h1 class="text-2xl md:text-4xl font-semibold text-blue-800 mb-4 leading-tight">
                        V Jornada de la Automoción 2026
                    </h1>

                    <p class="text-base md:text-lg text-gray-700 max-w-3xl mx-auto mb-6">
                        Un evento único para aprender, conectar y crecer. Más de 800 alumnos presentarán sus proyectos
                        finales, junto con ponencias y demostraciones del mundo de la automoción.
                    </p>

                    <p class="text-sm md:text-md text-gray-600 font-medium italic">
                        ¡Te esperamos el miércoles 27 de mayo en Nürburgreen Indoor!
                    </p>
                </section>

                <section class="py-8 px-2 md:px-6">
                    <h2 class="text-xl md:text-2xl font-semibold text-blue-800 mb-4">Mapa del evento</h2>

                    <div class="rounded-lg shadow-md border border-gray-100 overflow-hidden">
                        <img src="<?php echo e(asset('images/Mapa_Jornada.png')); ?>" alt="Mapa del evento"
                            class="w-full h-auto max-w-4xl mx-auto block">
                    </div>
                </section>
                <!-- 
                    <section class="px-6 pb-12">
                        <h2 class="text-2xl font-semibold text-blue-800 mb-4">Descarga nuestra app</h2>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="https://apps.apple.com/es/app/app-jornada-de-lautomoci%C3%B3/id6743483372"
                                style="display: inline-block; background-color: #000; color: white; border-radius: 8px; padding: 8px 16px; text-decoration: none; min-width: 160px;">
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 8px;">
                                        <img src="<?php echo e(asset('images/apple_logo.png')); ?>" alt="Apple"
                                            style="width: 24px; height: 24px;">
                                    </div>
                                    <div>
                                        <div style="font-size: 12px; font-weight: 300;">Consíguelo en el</div>
                                        <div style="font-size: 18px; font-weight: 600; line-height: 1.2;">App Store</div>
                                    </div>
                                </div>
                            </a>

                            <a href="https://play.google.com/store/apps/details?id=com.monlau.app_maquinista&pcampaignid=web_share"
                                style="display: inline-block; background-color: #000; color: white; border-radius: 8px; padding: 8px 16px; text-decoration: none; min-width: 160px;">
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 8px;">
                                        <img src="<?php echo e(asset('images/android_logo.png')); ?>" alt="Google Play"
                                            style="width: 24px; height: 24px;">
                                    </div>
                                    <div>
                                        <div style="font-size: 12px; font-weight: 300;">Disponible en</div>
                                        <div style="font-size: 18px; font-weight: 600; line-height: 1.2;">Google Play</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </section>
    -->
            </main>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/jornada-automocion-api/resources/views/dashboard.blade.php ENDPATH**/ ?>