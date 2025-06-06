<?php

use App\Http\Controllers\CocheReservadoController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\HabitacionesReservadasController;
use App\Http\Controllers\HotelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;

Route::middleware(['auth:admin'])->group(function () {
  
    Route::apiResource('coches-reservados', CocheReservadoController::class)->except(['show']);
    Route::apiResource('habitaciones-reservadas', HabitacionesReservadasController::class)->except(['show']);
    
});
Route::get('/coches/filtrar', [CocheController::class, 'filtrar']);
Route::get('/hoteles/filtrar', [HotelController::class, 'filtrar']);
Route::get('/habitaciones/filtrar', [HabitacionController::class, 'filtrar']);
Route::post('/coches-reservados', [CocheReservadoController::class, 'store']);
Route::post('/habitaciones-reservadas', [HabitacionesReservadasController::class, 'store']);
Route::apiResource('coches', CocheController::class)->only(['index', 'show']);
Route::apiResource('hoteles', HotelController::class)->only(['index', 'show']);
Route::apiResource('habitaciones', HabitacionController::class)->only(['index', 'show']);