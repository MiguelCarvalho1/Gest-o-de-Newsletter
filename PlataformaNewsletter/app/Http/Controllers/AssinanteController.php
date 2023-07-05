<?php

namespace App\Http\Controllers;
use App\Models\Assinante;
use App\Models\CodiPostal;
use App\Models\Pais;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AssinanteController extends Controller
{
    public function index()
    {
        // Retorna todos os assinantes
        $assinantes = Assinante::all();
        return view('/admin/assinante', compact('assinantes'));

       
    }

  

    public function show($id)
    {
        // Retorna a página de exibição de um assinante específico
        $assinante = Assinante::findOrFail($id);
        return view('assinantes.show', compact('assinante'));
    }

    public function redirecionarParaPaginaInicial()
    {
        // Realizar as ações necessárias aqui
        
        // Redirecionar para a página inicial
        return redirect('/');
    }

    public function create()
    {
      
      {
    $concelhos = CodiPostal::all();
    $tags = Tag::all();
    $pais = Pais::all();
    
    return view('assinante_create', compact('concelhos', 'tags', 'pais'));
}

        $pais = Pais::all();
        return view('assinante_create', compact('pais'));


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
    }
   /* public function edit($id)
    {
        // Retorna a view para editar um assinante específico
        $assinante = Assinante::findOrFail($id);
        return view('assinantes.edit', compact('assinante'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:assinantes,email,' . $id,
            'id_codiPostal' => 'required|exists:codiPostal,id'
        ]);

        // Atualiza os dados do assinante no banco de dados
        $assinante = Assinante::findOrFail($id);
        $assinante->update($validatedData);

        // Redireciona para a página de exibição do assinante atualizado
        return redirect()->route('/assinantes', $assinante->id);
    }

    public function destroy($id)
    {
        // Exclui um assinante do banco de dados
        $assinante = Assinante::findOrFail($id);
        $assinante->delete();

        // Redireciona para a página inicial dos assinantes
        return redirect()->route('assinantes.index');
    }*/
    public function store(Request $request)



    {
        $postalCode = CodiPostal::create([
            'codiPostal' => $request->codiPostal,
            'localidade' => $request->localidade,
            'pais' => $request->pais,
            'concelho' => $request->concelho,
        ]);


    
        $subscriber = Assinante::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'id_codiPostal' => $postalCode->id
        ]);

        
    // Obter as tags selecionadas
    $tagIds = $request->input('tags');

    // Salvar as tags selecionadas para o assinante
    $subscriber->tags()->attach($tagIds);
  
    
        // Faça qualquer outra ação necessária aqui, como exibir uma mensagem de sucesso
        $request->session()->flash('success', 'Subscrito com sucesso!');
    }
    

    public function destroy($id)
    {
        $noticia = Assinante::findOrFail($id);
        $noticia->delete();
    
        return redirect('/admin/assinante')->with('msg', 'Assinante excluído com sucesso!');
    }

    public function remover(Request $request)
    {
        $assinanteIds = json_decode($request->input('assinantes'));
    
        // Execute a lógica para remover os assinantes com base nos IDs recebidos
    
        // Exemplo de lógica de remoção
        foreach ($assinanteIds as $assinanteId) {
            $assinante = Assinante::find($assinanteId);
            if ($assinante) {
                $assinante->delete();
            }
        }
    
        return redirect()->back()->with('success', 'Assinantes removidos com sucesso');
    }

    public function enviarNewsletter(Request $request)
{
    $conteudo = $request->input('conteudo');
    $assinantes = Assinante::all(); // Recupera todos os inscritos

    foreach ($assinantes as $assinante) {
        // Lógica para enviar a newsletter para cada inscrito
        // Exemplo: Enviar um e-mail para o inscrito com o conteúdo da newsletter
        // Você pode usar pacotes como o Laravel Mail para enviar e-mails

        // Exemplo básico de envio de e-mail
        Mail::raw($conteudo, function ($message) use ($assinante) {
            $message->to($assinante->email)
                    ->subject('Nova newsletter');
        });
    }
}
    

}
