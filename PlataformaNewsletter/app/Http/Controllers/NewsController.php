<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Image;

class NewsController extends Controller
{
   
    public function index()
{
    $noticias = News::all();
    $noticias = News::with('images')->get();
    return view('/news/index', ['noticia' => $noticias]);






}

public function selecionar_news()
{
    $noticias = News::all();
    
    return view('/news/selecionar', ['noticia' => $noticias]);
}

public function home(){
    $noticias = News::all(); 
    $noticias = News::with('images')->get();
    return view('/home', ['noticia' => $noticias]);

}

public function show($id)
{
    $noticia = News::findOrFail($id);
    return view('/news/show_news', compact('noticia'));
}


public function show_home($id)
{
    $noticia = News::findOrFail($id);
    
    return view('/show', compact('noticia'));
}
    public function create()
{
    return view('/news/create_news');
}
public function store(Request $request)
{
    $noticia = new News;
    $noticia->titulo = $request->titulo;
    $noticia->conteudo = $request->conteudo;
    
    $noticia -> ativo = $request->ativo;

    $noticia->save();

    if ($request->hasFile('images')) {
        $images = $request->file('images');
    
        foreach ($images as $image) {
            $extension = $image->getClientOriginalExtension(); // Obtém a extensão do arquivo original
            $filename = time() . '_' . uniqid() . '.' . $extension; // Gera um nome de arquivo único
            $path = $image->move(public_path('images/noticias'), $filename);
            $url = 'images/noticias/' . $filename;

            $imageModel = new Image();
            $imageModel->url = $url;
            $imageModel->nome = $image->getClientOriginalName();
    
            $noticia->images()->save($imageModel);
        }
    }
    


    
    

        
    
    return redirect('/news')->with('msg', 'Notícia criada com sucesso!');
}

   /*  Função para abrir a view "Editar Noticia", onde é passado um $id como parâmetro.
        A variável $noticia guarda a Noticia com o $id passado como parâmetro.
        Retorna a view "Editar Noticia".*/
        public function editar_noticia($id){
            $noticia = News::findOrFail($id);
            return view('/news/edit_news', ['noticia' => $noticia]);
        }


        public function atualizar_noticia(Request $request, $id){

            $data = $request->validate([
                'titulo' => 'required',
                'conteudo' => 'required',
                'ativo' => 'required'
            ]);
            
            if ($request->hasFile('images')) {
                $images = $request->file('images');
            
                foreach ($images as $image) {
                    $extension = $image->getClientOriginalExtension(); // Obtém a extensão do arquivo original
                    $filename = time() . '_' . uniqid() . '.' . $extension; // Gera um nome de arquivo único
                    $path = $image->move(public_path('images/noticias'), $filename);
                    $url = 'images/noticias/' . $filename;
        
                    $imageModel = new Image();
                    $imageModel->url = $url;
            
                }
            }
        
            News::findOrFail($id)->update($data);
            return redirect('/news')->with('msg', 'Notícia atualizada com sucesso!');
        }

        public function destroy($id)
{
    $noticia = News::findOrFail($id);
    $noticia->delete();

    return redirect('/news')->with('msg', 'Notícia excluída com sucesso!');
}



    

}
