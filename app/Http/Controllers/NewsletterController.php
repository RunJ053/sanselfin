<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeNewsletter;
use Exception;

class NewsletterController extends Controller
{
    

public function subscribe(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:newsletter_subscribers,email'
    ]);

    try {
        $subscriber = NewsletterSubscriber::create([
            'email' => $request->email
        ]);

        Mail::to($subscriber->email)->send(new WelcomeNewsletter());

        return response()->json(['message' => 'Te has suscrito correctamente. Revisa tu correo 📧']);
    } catch (Exception $e) {

        return response()->json([
            'message' => 'Error al enviar el correo. Tal parece que ya se te ha enviado un correo.',
            'error' => $e->getMessage()
        ], 500);
    }
}
}