<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apicontroller;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ChatMessageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- ENDPOINTS PROTEGIDOS (Requieren Login) ---
Route::middleware('auth:sanctum')->group(function () {

    // Estudiantes y Perfil
    Route::get('/students/{limit}/{page}', [Apicontroller::class, 'students']);
    Route::get('/students/{limit}/{page}/{order}', [Apicontroller::class, 'students']);
    Route::get('/student/{id}', [Apicontroller::class, 'student']);
    Route::get('/my-profile', [Apicontroller::class, 'myProfile']);

    // --- ACCIONES DE MESAS Y RESERVAS ---

    // Ver mesas de una empresa
    Route::get('/companies/{id}/tables', [Apicontroller::class, 'getCompanyTables']); 

    // Ver horarios disponibles de una mesa
    Route::get('/tables/{id}/slots', [Apicontroller::class, 'get_table_slots']);
    
    // Crear mesa manualmente (POST)
    Route::post('/company-tables', [Apicontroller::class, 'createCompanyTable']); 

    // Reservar una hora (POST)
    Route::post('/tables/{id}/book', [Apicontroller::class, 'book_table_slot']);

    // Cancelar una reserva (POST)
    Route::post('/tables/{id}/cancel', [Apicontroller::class, 'cancel_table_slot']);

    // Filtrado de proyectos
    Route::get('/projects/{limit}/{page}/{filter}/{value}', [Apicontroller::class,'projects_filter']);
    Route::get('/projects/{limit}/{page}/{filter}/{value}/{order}', [Apicontroller::class,'projects_filter']);
    Route::get('/projectsFilterPages/{limit}/{filter}/{value}', [Apicontroller::class,'projects_filter_pages']);

    Route::get('/mesas', [MesasController::class, 'index'])->name('mesas.index');

    // ... dentro del middleware('auth:sanctum') ...

    Route::get('/my-profile', [Apicontroller::class, 'myProfile']);

    // --- AÑADIR ESTA LÍNEA ---
    Route::get('/my-bookings', [Apicontroller::class, 'getMyBookings']);

});

// --- ENDPOINTS PÚBLICOS ---

Route::post('/createToken', [Apicontroller::class, 'login_API']);
Route::get('/project/{id}', [Apicontroller::class, 'getProjectById']);

// =========================================================================
// 1. RUTAS ESPECÍFICAS (Deben ir ANTES de las genéricas de paginación)
// =========================================================================

// Sácala de cualquier grupo y ponla así:
Route::get('/proyecto/{idProject}/pdf', [App\Http\Controllers\StudentController::class, 'descargarProyectoPDF'])->name('project.pdf');

// Detalles individuales
Route::get('/companie/{id}', [Apicontroller::class, 'companie']);
Route::get('/presentation/{id}', [Apicontroller::class, 'presentation']);


// =========================================================================
// 2. RUTAS GENÉRICAS / PAGINACIÓN
// (Añadimos 'whereNumber' para que no confunda 'tables' con un número de página)
// =========================================================================

// Páginas (Contadores)
Route::get('/projectsPages/{limit}', [Apicontroller::class, 'pages_projects']);
Route::get('/companiesPages/{limit}', [Apicontroller::class, 'pages_companies']);
Route::get('/monlautechPages/{limit}', [Apicontroller::class, 'pages_dinamicTest']);
Route::get('/dynamicTestPages/{limit}', [Apicontroller::class, 'pages_dinamicTest']);
Route::get('/presentationsPages/{limit}', [Apicontroller::class, 'pages_presentations']);
Route::get('/studentsPages/{limit}', [Apicontroller::class, 'pages_students']);

// Listados
Route::get('/projects/{limit}/{page}', [Apicontroller::class, 'projects'])
    ->whereNumber('limit')->whereNumber('page');

Route::get('/projects/{limit}/{page}/{order}', [Apicontroller::class, 'projects'])
    ->whereNumber('limit')->whereNumber('page');

// AQUÍ ESTABA EL CONFLICTO: Añadimos restricción numérica
Route::get('/companies/{limit}/{page}', [Apicontroller::class, 'companies'])
    ->whereNumber('limit')->whereNumber('page');

Route::get('/companies/{limit}/{page}/{order}', [Apicontroller::class, 'companies'])
    ->whereNumber('limit')->whereNumber('page');

Route::get('/dynamicTest/{limit}/{page}', [Apicontroller::class, 'dynamictestings'])
    ->whereNumber('limit')->whereNumber('page');
Route::get('/dynamicTest/{limit}/{page}/{order}', [Apicontroller::class, 'dynamictestings'])
    ->whereNumber('limit')->whereNumber('page');
Route::get('/monlautech/{limit}/{page}', [Apicontroller::class, 'dynamictestings'])
    ->whereNumber('limit')->whereNumber('page');
Route::get('/monlautech/{limit}/{page}/{order}', [Apicontroller::class, 'dynamictestings'])
    ->whereNumber('limit')->whereNumber('page');

Route::get('/presentations/{limit}/{page}', [Apicontroller::class, 'presentations'])
    ->whereNumber('limit')->whereNumber('page');
Route::get('/presentations/{limit}/{page}/{order}', [Apicontroller::class, 'presentations'])
    ->whereNumber('limit')->whereNumber('page');


// Votaciones
Route::post('/projects/{id}/vote', [VoteController::class, 'store']);
Route::delete('/projects/{id}/vote', [VoteController::class, 'destroy']);
Route::post('/my-votes', [VoteController::class, 'myVotes']);


Route::prefix('presentations/{id}/chat')->group(function () {
    Route::middleware('auth:sanctum')->post('/', [ChatMessageController::class, 'store']);
    // Público (Alumnos e Invitados)
    Route::post('/', [ChatMessageController::class, 'store']);
    Route::get('/validated', [ChatMessageController::class, 'getValidated']);
    // Privado (Solo Profesores)
    Route::middleware('auth:sanctum')->get('/all', [ChatMessageController::class, 'getAll']);
});
 
// Moderación
Route::middleware('auth:sanctum')->post('chat/{messageId}/validate', [ChatMessageController::class, 'validateMessage']);
 