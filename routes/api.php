<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;

//rutas para login
Route::post('login', [AuthController::class, 'login']);

// Rutas para user
Route::get('users', [UserController::class, 'index']);
Route::post('regiter', [UserController::class, 'store']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

// Rutas para tarifas
Route::get('/tariffs', [TarifaController::class, 'index']);
Route::get('/tariffs/{tariff}', [TarifaController::class, 'show']);
Route::post('/tariffs', [TarifaController::class, 'store']);
Route::put('/tariffs/{tariff}', [TarifaController::class, 'update']);
Route::delete('/tariffs/{tariff}', [TarifaController::class, 'destroy']);

// Rutas para roles
Route::get('/roles', [RolesController::class, 'index']);
Route::get('/roles/{role}', [RolesController::class, 'show']);
Route::post('/roles', [RolesController::class, 'store']);
Route::put('/roles/{role}', [RolesController::class, 'update']);
Route::delete('/roles/{role}', [RolesController::class, 'destroy']);
