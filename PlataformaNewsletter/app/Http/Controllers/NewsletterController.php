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
        $title = $request->input('title');
        $content = $request->input('content');

        // Crie a newsletter com base nos IDs das notícias selecionadas, título e conteúdo
        $newsletter = new Newsletter();
        $newsletter->title = $title;
        $newsletter->content = $content;
        

            $newsIds = $request->input('newsIds');
            
            // Crie a newsletter com base nos IDs das notícias selecionadas
           
           
            $newsletter->save();
            dd($newsletter);
    
            // Vincule as notícias selecionadas à newsletter
            $newsletter->news()->attach($newsIds);
    
            // Execute outras ações necessárias, como enviar a newsletter por e-mail
    
             return redirect('/newsletters')->with('success', 'A newsletter foi criada com sucesso!');
        }
}
