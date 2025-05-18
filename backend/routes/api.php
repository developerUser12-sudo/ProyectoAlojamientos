<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocheController;
Route::apiResource('coches', CocheController::class)->except(['show']);
Route::get('/coches/filtrar', [CocheController::class, 'filtrar']);






