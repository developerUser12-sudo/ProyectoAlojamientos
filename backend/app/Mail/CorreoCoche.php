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
    public $lugar;

    /**
     * Create a new message instance.
     */
    public function __construct($usuario,$coche,$lugar)
    {
        $this->usuario = $usuario;
        $this->coche = $coche;
        $this->lugar = $lugar;
    }

    /**
     * Get the message envelope.
     */
   public function build()
{
    return $this->subject('Has reservado tu coche')
                ->view('emails.coche')
                ->with(['usuario' => $this->usuario,'coche'=> $this->coche,'lugar'=> $this->lugar]);
}

}
