<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
   
    public function index()
{
    $noticias = News::all();
    return view('/noticia/index', ['noticia' => $noticias]);
}

public function home(){
    $noticias = News::all(); 
    return view('/home', ['noticia' => $noticias]);

}
    public function create()
{
    return view('/news/create');
}
public function store(Request $request)
{
    $noticia = new News;
    $noticia->titulo = $request->titulo;
    $noticia->conteudo = $request->conteudo;
    
    $noticia -> ativo = $request->ativo;

    $noticia->save();

    if($request->hasFile('media') && $request->file('media')->isValid()) {

        $requestMedia = $request->media;

        $extension = $requestMedia->extension();

        $mediaName = md5($requestMedia->getClientOriginalName() . strtotime("now")) . "." . $extension;

        $requestMedia->move(public_path('img/news'), $mediaName);

        $noticia->media = $mediaName;

    }


    
    

        
    
    return redirect('/noticia')->with('msg', 'Notícia criada com sucesso!');
}

   /*  Função para abrir a view "Editar Noticia", onde é passado um $id como parâmetro.
        A variável $noticia guarda a Noticia com o $id passado como parâmetro.
        Retorna a view "Editar Noticia".*/
        public function editar_noticia($id){
            $noticia = News::findOrFail($id);
            return view('/noticia/editar_noticia', ['noticia' => $noticia]);
        }


        public function atualizar_noticia(Request $request, $id){

            $data = $request->validate([
                'titulo' => 'required',
                'conteudo' => 'required',
                'ativo' => 'required'
            ]);
            
            if($request->hasFile('media') && $request->file('media')->isValid()) {
        
                $requestMedia = $request->media;
        
                $extension = $requestMedia->extension();
        
                $mediaName = md5($requestMedia->getClientOriginalName() . strtotime("now")) . "." . $extension;
        
                $requestMedia->move(public_path('img/news'), $mediaName);
        
                $data['media'] = $mediaName;
        
            }
        
            News::findOrFail($id)->update($data);
            return redirect('/news')->with('msg', 'Notícia atualizada com sucesso!');
        }
    

}
