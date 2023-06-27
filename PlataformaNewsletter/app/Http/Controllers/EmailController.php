<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use App\Models\Assinante;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OlaEmail;

class EmailController extends Controller
{
    public function enviarEmail()
    {
        $assinantes = Assinante::pluck('email')->toArray(); // Obtém a lista de endereços de e-mail dos assinantes

        Mail::send('emails.ola', [], function ($message) use ($assinantes) {
            $message->to($assinantes)
                ->subject('Olá!');
        });

        // Define a mensagem de sucesso na sessão


        // Redireciona de volta à página "newsletters"
        return redirect()->back();
    }
}