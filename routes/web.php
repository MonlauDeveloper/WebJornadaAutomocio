<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Apicontroller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PresentationController;
use App\Http\Middleware\CheckUserStatus;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\MicrosoftAuthController;
use Illuminate\Support\Facades\DB; // Necesario para las consultas directas en rutas

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/ver-estado', function () {
    return view('verStatus');
})->name('ver-estado');

// Ruta para dashboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'check.status',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas del registro de empresa
Route::get('/register-empresa', function () {
    return view('auth.registerEmpresa');
})->name('register-empresa');

// Ruta para subir CSV de proyectos
Route::get('projects/subircsv', function () {
    return view('projects.upload_csv');
})->name('projects.upload_csv')
  ->middleware(['idRole:1', 'check.status']);

Route::post('projects/subircsv', [ProjectController::class, 'subirCsv'])
    ->name('projects.subircsv')
    ->middleware(['idRole:1', 'check.status']);

Route::post('projects/update-tribunal-ubication', [ProjectController::class, 'updateTribunalUbication'])
    ->name('projects.updateTribunalUbication')
    ->middleware(['idRole:1', 'check.status']);

// Rutas de proyectos
Route::resource('projects', ProjectController::class)
    ->only(['index', 'show'])
    ->middleware(['auth', 'check.status']);
Route::resource('projects', ProjectController::class)
    ->only(['create', 'edit', 'store', 'update', 'destroy'])
    ->middleware(['idRole:1,4', 'check.status']);

// --- RUTAS DE ADMINISTRACIÓN (Role 1) ---
Route::middleware(['auth', 'idRole:1'])->group(function () {
    
    // Gestión de Empresas y Solicitudes
    Route::get('/admin/empresas-aceptadas', [AdminController::class, 'indexAceptadas'])->name('admin.empresas_aceptadas');
    Route::get('/admin/crear/empresa', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/crear/empresa', [AdminController::class, 'store'])->name('admin.storeCompany');

    Route::get('/admin/solicitudes', [AdminController::class, 'index'])->name('admin.solicitudes');
    Route::get('/admin/solicitudes/{idUser}', [AdminController::class, 'show'])->name('admin.show_solicitud');
    Route::get('/admin/empresa-aceptada/{idUser}', [AdminController::class, 'showAceptada'])->name('admin.aprobadas_show');
    Route::post('/admin/solicitudes/{idUser}/aprobar', [AdminController::class, 'approve'])->name('admin.solicitudes.approve');
    Route::post('/admin/solicitudes/{idUser}/denegar', [AdminController::class, 'deny'])->name('admin.solicitudes.deny');
    Route::get('/admin/solicitudes/edit/{idUser}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/solicitudes/update/{idUser}', [AdminController::class, 'update'])->name('admin.update');

    // --- GESTIÓN DE MESAS (CORREGIDO Y SIN DUPLICADOS) ---

    // 1. Ver página: Listar mesas y cargar empresas para el select
    Route::get('/mesas', function () {
        // A. Mesas existentes
        $tables = DB::table('company_tables')
            ->join('companies', 'company_tables.idCompany', '=', 'companies.idCompany')
            ->select('company_tables.*', 'companies.companyName')
            ->orderBy('idTable', 'desc')
            ->get();

        // B. Lista de empresas para el desplegable
        $companies = DB::table('companies')
            ->select('idCompany', 'companyName')
            ->orderBy('companyName', 'asc')
            ->get();

        return view('mesas.index', compact('tables', 'companies')); 
    })->name('mesas.index');

    // 2. Guardar nueva mesa
    Route::post('/mesas', function (Illuminate\Http\Request $request) {
        $request->validate([
            'idCompany' => 'required|integer|exists:companies,idCompany',
            'tableName' => 'required|string|max:255',
        ]);

        DB::table('company_tables')->insert([
            'idCompany' => $request->idCompany,
            'tableName' => $request->tableName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Mesa asignada correctamente.');
    })->name('company-tables.store');

    // 3. Ver formulario de Edición (Cargando empresas para el select)
    Route::get('/mesas/{id}/edit', function ($id) {
        $table = DB::table('company_tables')->where('idTable', $id)->first();
        
        $companies = DB::table('companies')
            ->select('idCompany', 'companyName')
            ->orderBy('companyName', 'asc')
            ->get();
        
        return view('mesas.edit', compact('table', 'companies'));
    })->name('company-tables.edit');

    // 4. Guardar cambios de edición
    Route::put('/mesas/{id}', function (Illuminate\Http\Request $request, $id) {
        $request->validate([
            'idCompany' => 'required|integer|exists:companies,idCompany',
            'tableName' => 'required|string|max:255',
        ]);

        DB::table('company_tables')
            ->where('idTable', $id)
            ->update([
                'idCompany' => $request->idCompany,
                'tableName' => $request->tableName,
                'updated_at' => now(),
            ]);

        return redirect()->route('mesas.index')->with('success', 'Mesa actualizada correctamente.');
    })->name('company-tables.update');
    
    // 5. Borrar mesa
    Route::delete('/mesas/{id}', function ($id) {
        DB::table('company_tables')->where('idTable', $id)->delete();
        return back()->with('success', 'Asignación eliminada.');
    })->name('company-tables.destroy');

    // -----------------------------------------------------
    
    // Rutas extra de estudiantes para admin
    Route::get('/student/create', [StudentController::class, 'create'])->name('students.create');  
    Route::post('/student/subir', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/edit/{idStudent}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/update/{idStudent}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/delete/{idStudent}', [StudentController::class, 'destroy'])->name('students.destroy');
});

// Rutas Empresa (Role 5)
Route::middleware('idRole:5')->group(function () {
    Route::get('/empresa/mi-perfil', [AdminController::class, 'myProfile'])->name('admin.myProfile');
    Route::put('/empresa/mi-perfil/update', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
});

// Rutas de perfil de usuario (Password)
Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword')->middleware('auth');

// Rutas de estudiantes (Role 3)
Route::middleware('idRole:3')->group(function () {
    Route::get('students/mi-proyecto', [StudentController::class, 'myProject'])->name('students.myProject');
    Route::post('students/mi-proyecto/update', [StudentController::class, 'updateProject'])->name('students.updateProject');
    Route::get('students/mi-perfil', [StudentController::class, 'myProfile'])->name('students.myProfile');
    Route::post('/student/update-password', [StudentController::class, 'updatePassword'])->name('students.updatePassword');
    Route::post('students/mi-perfil/update', [StudentController::class, 'updateProfile'])->name('students.updateProfile');
});

// Rutas comunes Students (Auth + CheckStatus)
Route::middleware(['auth', 'check.status'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{idStudent}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/pdfDescargar/{idStudent}', [StudentController::class, 'descargarPDF'])->name('students.descargar');
});

Route::get('/pdfVer/{idStudent}', [StudentController::class, 'verPDF'])->name('students.showPDF');

// Rutas para ponencias (Role 1)
Route::middleware(['idRole:1', 'check.status'])->group(function () {
    Route::resource('presentations', PresentationController::class)->except(['show']);
    Route::get('presentations/{presentationId}/speakers', [SpeakerController::class, 'index'])->name('presentations.speaker');
    Route::post('presentation/{presentationId}/add-speaker', [SpeakerController::class, 'addSpeakerToPresentation'])->name('presentations.addSpeaker');
    Route::delete('presentation/{presentationId}/remove-speaker/{speakerId}', [SpeakerController::class, 'removeSpeakerFromPresentation'])->name('presentations.removeSpeaker');
    Route::get('presentation/{presentationId}/edit-speaker/{speakerId}', [SpeakerController::class, 'showEditSpeakerForm'])->name('presentations.editSpeaker');
    Route::put('presentation/{presentationId}/update-speaker/{speakerId}', [SpeakerController::class, 'updateSpeaker'])->name('presentations.updateSpeaker');
});

// Rutas para profesores (Role 4)
Route::middleware('idRole:4')->group(function () {
    Route::get('/mis-alumnos', [TeacherController::class, 'index'])->name('teachers.myStudents');
    Route::post('/professor/verify/{idStudent}', [TeacherController::class, 'verify'])->name('professor.verify');
    Route::get('/professor/verify/details/{idStudent}', [TeacherController::class, 'verifyDetails'])->name('professor.verifyDetails');
});

// Microsoft Routes
Route::get('auth/microsoft', [MicrosoftAuthController::class, 'redirectToMicrosoft'])->name('microsoft.login');
Route::get('/callback', [MicrosoftAuthController::class, 'handleMicrosoftCallback']);