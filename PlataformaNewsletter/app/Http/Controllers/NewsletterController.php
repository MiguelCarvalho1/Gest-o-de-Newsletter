<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;
use App\Models\News;
use Illuminate\Support\Facades\DB;


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
    $newsIds = explode(',', $request->input('selectedNews'));
    $titulo = $request->input('titulo');
    $conteudo = $request->input('conteudo');
    $dataEnvio = $request->input('data_envio');

    // Obter os dados das notícias correspondentes
    $news = News::whereIn('id', $newsIds)->get();

    // Crie a newsletter com base nos IDs das notícias selecionadas, título e conteúdo
    $newsletter = new Newsletter();
    $newsletter->titulo = $titulo;
    $newsletter->conteudo = "Olá [NOME_ASSINANTE], $conteudo";
    $newsletter->data_envio = $dataEnvio;

    $newsletter->save();

    // Vincule as notícias selecionadas à newsletter
    $newsletter->news()->attach($newsIds);

    // Execute outras ações necessárias, como enviar a newsletter por e-mail

    return redirect('/newsletters')->with('success', 'A newsletter foi criada com sucesso!');
}


public function show($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        return view('/newsletters/show_newsletter', compact('newsletter'));
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $noticia = News::all();
        return view('newsletters.edit_newsletter', compact('newsletter', 'noticia'));
    }

    public function update(Request $request, $id)
{
    // Obter a newsletter com o ID fornecido
    $newsletter = Newsletter::findOrFail($id);

    // Obter os dados do formulário de edição
    $titulo = $request->input('titulo');
    $conteudo = $request->input('conteudo');
    $dataEnvio = $request->input('data_envio');
    $selectedNews = $request->input('selectedNews');
    $newsIds = is_array($selectedNews) ? implode(',', $selectedNews) : $selectedNews;
    $newsIds = explode(',', $newsIds);

    // Atualizar os campos da newsletter
    $newsletter->titulo = $titulo;
    $newsletter->conteudo = "Olá [NOME_ASSINANTE], $conteudo";
    $newsletter->data_envio = $dataEnvio;

    $newsletter->save();

    // Remover as notícias vinculadas existentes
    $newsletter->news()->detach();

    // Vincular as novas notícias selecionadas à newsletter
    $newsletter->news()->attach($newsIds);

    return redirect('/newsletters')->with('success', 'A newsletter foi atualizada com sucesso!');
}
public function destroy($id)
{
    // Find the newsletter with the given ID
    $newsletter = Newsletter::findOrFail($id);

    // Detach the related news
    $newsletter->news()->detach();

    // Delete the newsletter
    $newsletter->delete();

    return redirect('/newsletters')->with('success', 'A newsletter foi excluída com sucesso!');
}

public function enviarNewsletters()
    {
        // Obtenha todas as newsletters a serem enviadas
        $newsletters = Newsletter::all();

        // Para cada newsletter
        foreach ($newsletters as $newsletter) {
            // Obtenha os assinantes dessa newsletter
            $assinantes = $newsletter->assinantes;

            // Para cada assinante
            foreach ($assinantes as $assinante) {
                $nomeAssinante = $assinante->nome;

                // Obtenha o conteúdo da newsletter
                $conteudoNewsletter = $newsletter->conteudo;

                // Faça a substituição da variável com o nome do assinante
                $conteudoPersonalizado = str_replace('[NOME_ASSINANTE]', $nomeAssinante, $conteudoNewsletter);

                // Envie a newsletter para o assinante com o conteúdo personalizado
                // ...
            }
        }
    }

    }

    
?>