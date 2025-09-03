<?php

namespace App\Mail;

use App\Models\FacturaCabecera;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FacturaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $factura;
    public $pdfPath;

    public function __construct(FacturaCabecera $factura, $pdfPath)
    {
        $this->factura = $factura;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Tu factura ' . $this->factura->numero_factura)
            ->view('emails.factura')
            ->attach($this->pdfPath);
    }
}

