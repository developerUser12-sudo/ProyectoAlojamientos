<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyNewEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $token)
    {
    }

    public function build()
    {
        return $this->view('emails.verify-new-email')
            ->subject('Confirma tu nuevo correo')
            ->with(['url' => url('/verify-new-email?token=' . $this->token)]);
    }

}
