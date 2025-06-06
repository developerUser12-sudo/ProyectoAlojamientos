<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BienvenidaUsuario extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
   public $usuario;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }

    public function build()
    {
        return $this->subject('¡Bienvenido a HolidaysNow!')
                    ->view('emails.bienvenida');
    }
}
