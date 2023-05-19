<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use App\Models\News;


use Illuminate\Http\Request;

class NewsletterController extends Controller
{


    
        public function index()
        {
            $newsletters = Newsletter::all();
            
            return view('/newsletters/index', ['newsletters' => $newsletters]);
            
        }



    public function create(Request $request)
    {
    $newsIds = $request->input('newsIds');

    // Obter as notícias selecionadas do banco de dados
    $selectedNews = News::whereIn('id', $newsIds)->get();

    // Criar o conteúdo da newsletter com base nas notícias selecionadas
    $newsletterContent = '';
    foreach ($selectedNews as $news) {
        $newsletterContent .= "Título: " . $news->titulo . "\n";
        $newsletterContent .= "Conteúdo: " . $news->conteudo . "\n";
        $newsletterContent .= "--------------------------------\n";
    }

    // Aqui você pode adicionar a lógica para salvar a newsletter no banco de dados, enviar por e-mail, etc.

    return redirect('/newsletters')->json(['message' => 'A newsletter foi criada com sucesso!', 'newsletterContent' => $newsletterContent]);
}
}
