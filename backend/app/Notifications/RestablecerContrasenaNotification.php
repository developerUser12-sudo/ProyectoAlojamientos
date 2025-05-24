<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RestablecerContrasenaNotification extends Notification
{
     public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));

        return (new MailMessage)
            ->subject('Restablecer Contraseña')
            ->greeting('¡Hola!')
            ->line('Recibes este correo porque solicitaste restablecer tu contraseña.')
            ->action('Restablecer contraseña', $resetUrl)
            ->line('Si no solicitaste este cambio, no hagas nada.')
            ->salutation('Saludos, HolidaysNow');   
    }
}
