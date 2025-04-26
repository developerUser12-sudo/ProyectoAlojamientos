<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Mostrar formulario de login de administrador
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Login de administrador
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.paneladministracion');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    // Logout de administrador
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.loginAdmin');
    }
}
