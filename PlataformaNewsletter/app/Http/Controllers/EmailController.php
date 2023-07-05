<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use App\Models\News;
use App\Models\Assinante;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OlaEmail;
use App\Models\Registro;

class EmailController extends Controller
{
    public function enviarEmail(Request $request, $newsletterId)
    {
        $assinantes = Assinante::all(); // Obter todos os assinantes
    
        $assinanteInfos = DB::table('assinantes')
            ->join('codiPostal', 'assinantes.id_codiPostal', '=', 'codiPostal.id')
            ->select('assinantes.id', 'assinantes.nome', 'codiPostal.concelho')
            ->get();
    
        $newsletter = Newsletter::find($newsletterId);
        if (!$newsletter) {
            // Tratar a situação em que a newsletter não existe
        }
    
        $tituloNewsletter = $newsletter->titulo;
        $conteudoNewsletter = $newsletter->conteudo;
    
        $newsIds = $newsletter->news()->pluck('news_id')->toArray();
        $news = News::whereIn('id', $newsIds)->with('images')->get();
    
        foreach ($assinantes as $assinante) {
            $assinanteInfo = $assinanteInfos->firstWhere('id', $assinante->id);
    
            $nomeAssinante = $assinanteInfo->nome;
            $concelhoAssinante = $assinanteInfo->concelho;
    
            $conteudoComNome = str_replace('[NOME]', $nomeAssinante, $conteudoNewsletter);
            $conteudoComConcelho = str_replace('[CONCELHO]', $concelhoAssinante, $conteudoComNome);
    
            // Enviar o e-mail para o assinante com o conteúdo personalizado
            Mail::send('emails.ola', ['titulo' => $tituloNewsletter, 'conteudo' => $conteudoComConcelho, 'news' => $news], function ($message) use ($assinante) {
                $message->to($assinante->email)
                    ->subject('Olá!');
            });
        }
        
        $assinantesRecebidos = count($assinantes);
        $registro = Registro::firstOrNew(['user_id' => auth()->user()->id]);
        $registro->newsletter_enviadas += 1; // Incrementar o valor para cada newsletter enviada
        $registro->newsletter_recebidas += $assinantesRecebidos; // Atualizar o campo com o número de assinantes que receberam
        $registro->save();
        // Define a mensagem de sucesso na sessão
    
        // Redireciona de volta à página "newsletters"
        return redirect()->back();
    }
    

    
}


