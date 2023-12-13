<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Rutas para tarifas
Route::get('tarifas', [TarifaController::class, 'index']);
Route::post('tarifas', [TarifaController::class, 'store']);
Route::get('tarifas/{tarifa}', [TarifaController::class, 'show']);
Route::put('tarifas/{tarifa}', [TarifaController::class, 'update']);
Route::delete('tarifas/{tarifa}', [TarifaController::class, 'destroy']);

// Rutas para paquetes
Route::get('paquetes', [PaqueteController::class, 'index']);
Route::post('paquetes', [PaqueteController::class, 'store']);
Route::get('paquetes/{paquete}', [PaqueteController::class, 'show']);
Route::put('paquetes/{paquete}', [PaqueteController::class, 'update']);
Route::delete('paquetes/{paquete}', [PaqueteController::class, 'destroy']);

// Rutas para user
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

//rutas para login
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);