<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AccountController extends Controller
{
     public function updateUsername(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();
        $user->name = $request->username;
        $user->save();

        return redirect()->back();
    }
}
