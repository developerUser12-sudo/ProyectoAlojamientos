<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.paneladministracion');
        }

        return back()->with('error','Una o más credenciales son incorrectas');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.loginAdmin');
    }
}
