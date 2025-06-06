<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailChangeRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EmailChangeController extends Controller
{

    public function requestChange(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email',
        ]);

        $token = Str::random(64);
        EmailChangeRequest::create([
            'user_id' => auth()->id(),
            'new_email' => $request->new_email,
            'token' => $token,
            'expires_at' => Carbon::now()->addMinutes(60),
        ]);

        Mail::to($request->new_email)->send(new \App\Mail\VerifyNewEmail($token));

        return response()->json(['message' => 'Se ha enviado un correo de verificación.']);
    }
    public function verify(Request $request)
    {
        $record = EmailChangeRequest::where('token', $request->token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Token inválido o expirado'], 400);
        }

        $user = $record->user;
        $user->email = $record->new_email;
        $user->save();

        $record->delete();

        return redirect(config('app.frontend_url') )->with('success', 'Correo actualizado');
    }

}
