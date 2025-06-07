<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificarNuevoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    public $newEmail;
    public $token;

    public function __construct($user, $newEmail, $token)
    {
        $this->user = $user;
        $this->newEmail = $newEmail;
        $this->token = $token;
    }

    public function build()
{
    return $this->view('emails.verificar-nuevo-email')
                ->subject('Confirma tu nuevo correo')
                ->with([
                    'usuario' => $this->user,
                    'token' => $this->token,
                ]);
}



}
