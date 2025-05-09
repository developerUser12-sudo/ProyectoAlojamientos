<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.loginAdmin');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.loginAdmin.post');
Route::middleware('auth')->get('/api/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/paneladministracion', function () {
        return view('admin.paneladministracion');
    })->name('admin.paneladministracion');

    Route::get('admin/crear-coche', function () {
        return view('admin.crearcoche');
    })->name('admin.crearcoche');
    

    Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logoutAdmin');
});
Route::get('/username', function () {
    $user = Auth::user();
    if ($user) {
        return response()->json(['username' => $user->name]);
    } else {
        return response()->json(['username' => 'invitado']);
    }   
});
    
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de autenticación (breeze)
require __DIR__.'/auth.php';
