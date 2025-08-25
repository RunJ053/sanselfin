<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewsletter extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('¡Bienvenido a nuestro Ecommerce!')
            ->view('emails.welcome_newsletter')
                ->attach(public_path('pdfs/catalogo.pdf')); // tu PDF en public/pdfs/
    }
}

