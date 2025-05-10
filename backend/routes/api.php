<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;
Route::post('/crearCoche', [CocheController::class, 'store']);
Route::apiResource('coches', CocheController::class);






