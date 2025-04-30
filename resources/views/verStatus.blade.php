@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center bg-gray-100 py-12 px-6">
        <div class="max-w-md w-full bg-white shadow-md rounded-lg p-8">
            @if(auth()->user()->status === 'pending')
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6">
                    <p class="font-semibold">Tu solicitud está siendo revisada.</p>
                    <p>Gracias por tu paciencia. Nuestro equipo está evaluando tu solicitud y te notificaremos cuando tengamos una actualización. Si tienes alguna pregunta, no dudes en contactarnos.</p>
                </div>
            @elseif(auth()->user()->status === 'denied')
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                    <p class="font-semibold">Lamentablemente, tu solicitud ha sido rechazada.</p>
                    <p>Después de revisar tu solicitud, no podemos aprobarla en este momento. Si deseas recibir más detalles o tienes preguntas, por favor contáctanos directamente.</p>
                </div>
            @else
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                    <p class="font-semibold">¡Felicidades! Tu solicitud ha sido aprobada.</p>
                    <p>¡Gracias por ser parte de nuestra comunidad! Ahora puedes acceder a todos los beneficios disponibles. Si tienes alguna pregunta, no dudes en ponerte en contacto con nosotros.</p>
                </div>
            @endif

            <div class="text-center mt-8">
                <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">Contacto</a>
            </div>
        </div>
    </div>
@endsection
