<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apicontroller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ENDPOINTS APIS
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/projectsPages/{limit}', [Apicontroller::class, 'pages_projects']);
    Route::get('/companiesPages/{limit}', [Apicontroller::class, 'pages_companies']);
    Route::get('/monlautechPages/{limit}', [Apicontroller::class, 'pages_dinamicTest']);
    Route::get('/dynamicTestPages/{limit}', [Apicontroller::class, 'pages_dinamicTest']);
    Route::get('/presentationsPages/{limit}', [Apicontroller::class, 'pages_presentations']);
    Route::get('/studentsPages/{limit}', [Apicontroller::class, 'pages_students']);
    Route::get('/projects/{limit}/{page}', [Apicontroller::class, 'projects']);
    Route::get('/projects/{limit}/{page}/{order}', [Apicontroller::class, 'projects']);
    Route::get('/companies/{limit}/{page}', [Apicontroller::class, 'companies']);
    Route::get('/companies/{limit}/{page}/{order}', [Apicontroller::class, 'companies']);
    Route::get('/dynamicTest/{limit}/{page}', [Apicontroller::class, 'dynamictestings']);
    Route::get('/dynamicTest/{limit}/{page}/{order}', [Apicontroller::class, 'dynamictestings']);
    Route::get('/monlautech/{limit}/{page}', [Apicontroller::class, 'dynamictestings']);
    Route::get('/monlautech/{limit}/{page}/{order}', [Apicontroller::class, 'dynamictestings']);
    Route::get('/presentations/{limit}/{page}', [Apicontroller::class, 'presentations']);
    Route::get('/presentations/{limit}/{page}/{order}', [Apicontroller::class, 'presentations']);
    Route::get('/students/{limit}/{page}', [Apicontroller::class, 'students']);
    Route::get('/students/{limit}/{page}/{order}', [Apicontroller::class, 'students']);
    Route::get('/companie/{id}', [Apicontroller::class, 'companie']);
    Route::get('/presentation/{id}', [Apicontroller::class, 'presentation']);
    Route::get('/student/{id}', [Apicontroller::class, 'student']);

    Route::get('/projects/{limit}/{page}/{filter}/{value}', [Apicontroller::class,'projects_filter'])->middleware('auth:sanctum');
    Route::get('/projects/{limit}/{page}/{filter}/{value}/{order}', [Apicontroller::class,'projects_filter'])->middleware('auth:sanctum');
    Route::get('/projectsFilterPages/{limit}/{filter}/{value}', [Apicontroller::class,'projects_filter_pages'])->middleware('auth:sanctum');
});

Route::post('/createToken', [Apicontroller::class, 'login_API']);