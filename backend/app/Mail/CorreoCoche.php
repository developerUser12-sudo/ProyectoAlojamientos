<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CorreoCoche extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $usuario;
    public $coche;
    public $codigoReserva;

    /**
     * Create a new message instance.
     */
    public function __construct($usuario,$coche, $codigoReserva)
    {
        $this->usuario = $usuario;
        $this->coche = $coche;
        $this->codigoReserva = $codigoReserva;
    }

    /**
     * Get the message envelope.
     */
   public function build()
{
    return $this->subject('Has reservado tu coche')
                ->view('emails.coche')
                ->with(['usuario' => $this->usuario,'coche'=> $this->coche,'codigo_reserva'=> $this->codigoReserva]);
}

}
