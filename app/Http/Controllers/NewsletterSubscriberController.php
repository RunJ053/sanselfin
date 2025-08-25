<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewsletter;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email'
        ]);

        // Guardar el correo en DB
        $subscriber = NewsletterSubscriber::create([
            'email' => $request->email
        ]);

        // Enviar correo de bienvenida con PDF adjunto
        Mail::to($subscriber->email)->send(new WelcomeNewsletter());

        return response()->json(['message' => 'Te has suscrito correctamente. Revisa tu correo 📧']);
    }
}