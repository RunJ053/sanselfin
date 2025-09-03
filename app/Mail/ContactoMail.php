<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $detalles;

    public function __construct($detalles)
    {
        $this->detalles = $detalles;
    }

    public function build()
    {
        return $this->subject($this->detalles['asunto'])
                    ->view('emails.contacto');
    }
}
