<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use App\Models\News;
use App\Models\Assinante;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OlaEmail;

class EmailController extends Controller
{
    public function enviarEmail(Request $request, $newsletterId)
    {
        $assinantes = Assinante::pluck('email')->toArray(); // Obtém a lista de endereços de e-mail dos assinantes
    
        $newsletter = Newsletter::find($newsletterId);
        if (!$newsletter) {
            // Tratar a situação em que a newsletter não existe
        }
    
        $tituloNewsletter = $newsletter->titulo;
        $conteudoNewsletter = $newsletter->conteudo;
    
        $newsIds = $newsletter->news()->pluck('news_id')->toArray(); // Array de IDs das notícias associadas à newsletter
        $news = News::whereIn('id', $newsIds)->with('images')->get(); // Obtém as notícias associadas à newsletter, incluindo as imagens
    
        Mail::send('emails.ola', ['titulo' => $tituloNewsletter, 'conteudo' => $conteudoNewsletter, 'news' => $news], function ($message) use ($assinantes) {
            $message->to($assinantes)
                ->subject('Olá!');
        });
    
        // Define a mensagem de sucesso na sessão
    
        // Redireciona de volta à página "newsletters"
        return redirect()->back();
    }
}


