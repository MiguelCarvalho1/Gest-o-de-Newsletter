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
            $newsIds = $request->input('newsIds');
            $title = $request->input('titulo');
            $content = $request->input('conteudo');
    
            // Obter os dados das notícias correspondentes
            $news = News::whereIn('id', $newsIds)->get();
    
            // Crie a newsletter com base nos IDs das notícias selecionadas, título e conteúdo
            $newsletter = new Newsletter();
            $newsletter->title = $title;
            $newsletter->content = $content;
    
            $newsletter->save();
    
            // Vincule as notícias selecionadas à newsletter
            $newsletter->news()->attach($newsIds);
    
            // Execute outras ações necessárias, como enviar a newsletter por e-mail
    
            return redirect('/newsletters')->with('success', 'A newsletter foi criada com sucesso!');
        }
    }
?>