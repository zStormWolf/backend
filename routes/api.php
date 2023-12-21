<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Middleware\CheckUserRole;

//rutas para login
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [UserController::class, 'store']);

// Rutas para user
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/{id}', [UserController::class, 'update']);

// Rutas para tarifas
Route::get('/tariffs/{id}', [TarifaController::class, 'show']);
Route::post('/tariffs', [TarifaController::class, 'store']);
Route::put('/tariffs/{id}', [TarifaController::class, 'update']);
Route::delete('/tariffs/{id}', [TarifaController::class, 'destroy']);

// Rutas para roles
Route::get('/roles', [RolesController::class, 'index']);
Route::get('/roles/{id}', [RolesController::class, 'show']);;
Route::post('/roles', [RolesController::class, 'store']);
Route::put('/roles/{id}', [RolesController::class, 'update']);
Route::delete('/roles/{id}', [RolesController::class, 'destroy']);

//middleware
Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});

Route::get('/tariffs', [TarifaController::class, 'index']);

