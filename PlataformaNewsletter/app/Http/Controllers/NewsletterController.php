<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\News;
use App\Models\Assinante;
use App\Models\Tag;





use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();
        return view('newsletters.index', ['newsletters' => $newsletters]);
    }

    /*Nesta seção do código, ocorre o processo de criação de uma nova newsletter. Os IDs das 
    notícias selecionadas são obtidos e armazenados na variável $newsIds. 
    Em seguida, são obtidos o título, conteúdo e data de envio da newsletter
     a partir das informações enviadas via requisição. A partir dos IDs das 
     notícias selecionadas, são buscados os dados das notícias e tags correspondentes.

    Após isso, uma nova instância do modelo Newsletter é criada e o título é atribuído a ela.
     É feita uma verificação para substituir placeholders no conteúdo da newsletter com informações 
     do assinante, como nome e concelho. Caso haja um assinante válido, o nome e concelho 
     são obtidos e os placeholders são substituídos no conteúdo. Caso contrário, o conteúdo
      permanece o mesmo.

    A data de envio da newsletter é definida e, em seguida, a
     newsletter é salva no banco de dados. No final do código, ocorre o
      redirecionamento para a página de newsletters com uma mensagem de sucesso.*/

    public function create(Request $request)
    {
        $newsIds = explode(',', $request->input('selectedNews'));
        $titulo = $request->input('titulo');
        $conteudo = $request->input('conteudo');
        $dataEnvio = $request->input('data_envio');

        // Obter os dados das notícias correspondentes
        $news = News::whereIn('id', $newsIds)->get();
        $tagsInput = $request->input('tags');
        $tagsArray = explode(',', $tagsInput);
        $tagIds = [];

        // Crie ou recupere os registros das tags no banco de dados
        foreach ($tagsArray as $tagName) {
            $tagName = strtolower(trim($tagName));
            $tag = Tag::where('nome', $tagName)->first();

            if (!$tag) {
                $tag = new Tag();
                $tag->nome = $tagName;
                $tag->save();
            }

            $tagIds[] = $tag->id;
        }

        // Crie a newsletter com base nos IDs das notícias selecionadas, título e conteúdo
        $newsletter = new Newsletter();
        $newsletter->titulo = $titulo;

        $assinante = DB::table('assinantes')
            ->join('codiPostal', 'assinantes.id_codiPostal', '=', 'codiPostal.id')
            ->inRandomOrder()
            ->select('assinantes.nome', 'codiPostal.concelho')
            ->first();

        if ($assinante) {
            $nomeAssinante = $assinante->nome;
            $concelhoAssinante = $assinante->concelho;

            $conteudoComNome = preg_replace('/\[NOME\]/', $nomeAssinante, $conteudo);
            $conteudoComConcelho = preg_replace('/\[CONCELHO\]/', $concelhoAssinante, $conteudoComNome);

            $newsletter->conteudo = $conteudoComConcelho;
        } else {
            $newsletter->conteudo = $conteudo;
        }

        $newsletter->data_envio = $dataEnvio;
        $newsletter->save();

        $newsletter->news()->detach();
        $newsletter->news()->attach($newsIds);

        $newsletter->tags()->attach($tagIds);

        return redirect('/newsletters')->with('success', 'A newsletter foi criada com sucesso!');
    }


    public function show($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        return view('newsletters.show_newsletter', compact('newsletter'));
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

        // Modificar o conteúdo da newsletter com nome e concelho do assinante
        $assinante = Auth::user(); // Substitua por sua lógica para obter o assinante atualmente logado
        if ($assinante) {
            $nomeAssinante = $assinante->nome;
            $concelhoAssinante = $assinante->concelho;

            // Substitua '[NOME_ASSINANTE]' pelo nome do assinante
            $conteudoComNome = preg_replace('/\[NOME\]/', $nomeAssinante, $conteudo);

            // Substitua '[CONCELHO_ASSINANTE]' pelo concelho do assinante
            $conteudoComConcelho = preg_replace('/\[CONCELHO\]/', $concelhoAssinante, $conteudoComNome);

            $newsletter->conteudo = $conteudoComConcelho;
        } else {
            $newsletter->conteudo = $conteudo;
        }

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


    
}
