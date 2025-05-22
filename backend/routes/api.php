<?php

use App\Http\Controllers\CocheReservadoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;
Route::apiResource('coches', CocheController::class)->except(['show']);
Route::apiResource('coches-reservados', CocheReservadoController::class)->except(['show']);
Route::get('/coches/filtrar', [CocheController::class, 'filtrar']);
Route::post('/coches-reservados', [CocheReservadoController::class, 'store']);





