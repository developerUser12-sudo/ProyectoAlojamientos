<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailChangeRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class CambiarEmailController extends Controller
{

    public function requestChange(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
        ]);
        if (\App\Models\User::where('email', $request->new_email)->exists()) {
            return redirect()->back()->withErrors(['error' => 'El correo ya está en uso']) ->withInput();
        }


        $token = Str::random(64);
        EmailChangeRequest::create([
            'user_id' => auth()->id(),
            'new_email' => $request->new_email,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(60),
        ]);
        Mail::to($request->new_email)->send(new \App\Mail\VerificarNuevoEmail($request->user(), $request->new_email, $token));

        return redirect()->back()->with('status', 'Se ha enviado un correo de verificación.');

    }
    public function confirmChange($token)
    {
        $request = EmailChangeRequest::where('token', $token)
            ->where('expires_at', '>', now())
            ->firstOrFail();

        $user = $request->user;
        $user->email = $request->new_email;
        $user->save();

        $request->delete();

        return redirect(config('app.url') . '/cuenta')->with('correoCambiado', 'Correo cambiado correctamente');
    }

}
