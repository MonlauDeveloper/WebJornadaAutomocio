<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apicontroller;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\StudentController;

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
    Route::get('/my-bookings', [Apicontroller::class, 'getMyBookings']);

    // --- ACCIONES DE MESAS Y RESERVAS ---
    Route::get('/companies/{id}/tables', [Apicontroller::class, 'getCompanyTables']);
    Route::get('/tables/{id}/slots', [Apicontroller::class, 'get_table_slots']);
    Route::post('/company-tables', [Apicontroller::class, 'createCompanyTable']);
    Route::post('/tables/{id}/book', [Apicontroller::class, 'book_table_slot']);
    Route::post('/tables/{id}/cancel', [Apicontroller::class, 'cancel_table_slot']);

    // Filtrado de proyectos
    Route::get('/projects/{limit}/{page}/{filter}/{value}', [Apicontroller::class, 'projects_filter']);
    Route::get('/projects/{limit}/{page}/{filter}/{value}/{order}', [Apicontroller::class, 'projects_filter']);
    Route::get('/projectsFilterPages/{limit}/{filter}/{value}', [Apicontroller::class, 'projects_filter_pages']);

    // Moderación de Chat
    Route::post('chat/{messageId}/validate', [ChatMessageController::class, 'validateMessage']);
});

// --- ENDPOINTS PÚBLICOS ---

Route::post('/createToken', [Apicontroller::class, 'login_API']);
Route::get('/project/{id}', [Apicontroller::class, 'getProjectById']);

// NUEVA RUTA: Búsqueda Global para Flutter (Importante ponerla antes de las paginaciones)
Route::get('/projects/search/{query}', [Apicontroller::class, 'search_projects_global']);

// PDFs y Detalles
Route::get('/proyecto/{idProject}/pdf', [StudentController::class, 'descargarProyectoPDF'])->name('project.pdf');
Route::get('/companie/{id}', [Apicontroller::class, 'companie']);
Route::get('/presentation/{id}', [Apicontroller::class, 'presentation']);

// --- PAGINACIÓN Y LISTADOS ---

// Páginas (Contadores)
Route::get('/projectsPages/{limit}', [Apicontroller::class, 'pages_projects']);
Route::get('/companiesPages/{limit}', [Apicontroller::class, 'pages_companies']);
Route::get('/monlautechPages/{limit}', [Apicontroller::class, 'pages_dinamicTest']);
Route::get('/dynamicTestPages/{limit}', [Apicontroller::class, 'pages_dinamicTest']);
Route::get('/presentationsPages/{limit}', [Apicontroller::class, 'pages_presentations']);
Route::get('/studentsPages/{limit}', [Apicontroller::class, 'pages_students']);

// Proyectos
Route::get('/projects/{limit}/{page}', [Apicontroller::class, 'projects'])->whereNumber('limit')->whereNumber('page');
Route::get('/projects/{limit}/{page}/{order}', [Apicontroller::class, 'projects'])->whereNumber('limit')->whereNumber('page');

// Empresas
Route::get('/companies/{limit}/{page}', [Apicontroller::class, 'companies'])->whereNumber('limit')->whereNumber('page');
Route::get('/companies/{limit}/{page}/{order}', [Apicontroller::class, 'companies'])->whereNumber('limit')->whereNumber('page');

// MonlauTech / DynamicTest
Route::get('/dynamicTest/{limit}/{page}', [Apicontroller::class, 'dynamictestings'])->whereNumber('limit')->whereNumber('page');
Route::get('/dynamicTest/{limit}/{page}/{order}', [Apicontroller::class, 'dynamictestings'])->whereNumber('limit')->whereNumber('page');
Route::get('/monlautech/{limit}/{page}', [Apicontroller::class, 'dynamictestings'])->whereNumber('limit')->whereNumber('page');
Route::get('/monlautech/{limit}/{page}/{order}', [Apicontroller::class, 'dynamictestings'])->whereNumber('limit')->whereNumber('page');

// Presentaciones
Route::get('/presentations/{limit}/{page}', [Apicontroller::class, 'presentations'])->whereNumber('limit')->whereNumber('page');
Route::get('/presentations/{limit}/{page}/{order}', [Apicontroller::class, 'presentations'])->whereNumber('limit')->whereNumber('page');

// Votaciones
Route::post('/projects/{id}/vote', [VoteController::class, 'store']);
Route::delete('/projects/{id}/vote', [VoteController::class, 'destroy']);
Route::post('/my-votes', [VoteController::class, 'myVotes']);
Route::get('/votes/ranking', [VoteController::class, 'ranking']);

// Chat de Presentaciones
Route::prefix('presentations/{id}/chat')->group(function () {
    Route::post('/', [ChatMessageController::class, 'store']); // Público e Invitados
    Route::get('/validated', [ChatMessageController::class, 'getValidated']);
    Route::middleware('auth:sanctum')->get('/all', [ChatMessageController::class, 'getAll']);
});