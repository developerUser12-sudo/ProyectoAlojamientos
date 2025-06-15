<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CancelaServicio extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $usuario;
    public $habitacion;
    public $hotel;
    public $coche;

    /**
     * Create a new message instance.
     */
    public function __construct($usuario,$habitacion=null,$hotel=null, $coche=null)
    {
        $this->usuario = $usuario;
        $this->habitacion = $habitacion;
        $this->hotel = $hotel;
        $this->coche = $coche;

    }

    /**
     * Get the message envelope.
     */
   public function build()
{
    return $this->subject('Has reservado tu habitación de hotel')
                ->view('emails.cancelar')
                ->with(['usuario' => $this->usuario,'habitacion'=> $this->habitacion,'hotel'=> $this->hotel,'coche'=> $this->coche]);
}
}
