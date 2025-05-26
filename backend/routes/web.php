<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\CocheReservadoController;
use App\Http\Controllers\ReservadosController;
use App\Models\CocheReservado;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.loginAdmin');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.loginAdmin.post');



Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/paneladministracion', [ServicesController::class, 'index'])->name('admin.paneladministracion');
       Route::get('admin/actualizar-coche/{id}', [CocheController::class, 'edit'])->name('admin.actualizarcoche');


    Route::get('admin/crear-coche', function () {
        return view('admin.crearcoche');
    })->name('admin.crearcoche');
    Route::post('/crearCoche', [CocheController::class, 'store'])->name('admin.createcoche');
    Route::put('admin/actualizar-coche/{id}', [CocheController::class, 'update'])->name('admin.updatecoche');
    Route::delete('admin/eliminar-coche/{id}', [CocheController::class, 'destroy'])->name('admin.deletecoche');
    
    Route::get('admin/crear-hotel', function () {
        return view('admin.crearhotel');
    })->name('admin.crearhotel');
    Route::post('/crearHotel', [HotelController::class, 'store'])->name('admin.createhotel');
    Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logoutAdmin');
});



Route::get('/username', function () {
     $user = Auth::user();

    if ($user) {
        return response()->json([
            'id' => $user->id,
            'username' => $user->name,
        ]);
    } else {
        return response()->json([
            'id' => null,
            'username' => 'invitado',
        ]);
    }
});

Route::get('/reservas',[ReservadosController::class,'index'])->name('reservas');
Route::delete('reservas/{id}', [CocheReservadoController::class, 'destroy'])->name('cancelarreserva');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
