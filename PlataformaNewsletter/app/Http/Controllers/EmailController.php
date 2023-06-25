<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OlaEmail;

class EmailController extends Controller
{
    public function enviarEmail()
    {
        $email = 'ritapinto33@outlook.com'; // Insira o endereço de e-mail de destino aqui

        Mail::send('emails.ola', [], function ($message) use ($email) {
            $message->to($email)
                ->subject('Olá!');
        });

        return 'E-mail enviado com sucesso!';
    }
}


/*
class EmailController extends Controller
{
    public function index ()
    {
        return view ('welcome');
    }

public function store (Request $request)
    {
        $email= $request->email;
        $message= $request->email;
        dd($email.$message);
    }

} */

