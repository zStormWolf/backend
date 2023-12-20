<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// // Rutas para tarifas
Route::get('/tariffs', [TariffController::class, 'index']);
Route::get('/tariffs/{tariff}', [TariffController::class, 'show']);
Route::post('/tariffs', [TariffController::class, 'store']);
Route::put('/tariffs/{tariff}', [TariffController::class, 'update']);
Route::delete('/tariffs/{tariff}', [TariffController::class, 'destroy']);



// Rutas para user
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

//rutas para login
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
