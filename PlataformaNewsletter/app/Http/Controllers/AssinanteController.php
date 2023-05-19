<?php

namespace App\Http\Controllers;
use App\Models\Assinante;
use App\Models\CodiPostal;
use Illuminate\Http\Request;

class AssinanteController extends Controller
{
    public function index()
    {
        // Retorna todos os assinantes
        $assinantes = Assinante::all();
        return view('assinantes.index', compact('assinantes'));
    }

  

    public function show($id)
    {
        // Retorna a página de exibição de um assinante específico
        $assinante = Assinante::findOrFail($id);
        return view('assinantes.show', compact('assinante'));
    }


    public function create()
    {
        // Retorna a página de exibição de um assinante específico
        
        return view('assinante_create');
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
        //dd($request) ;
       /* $data = $request->validate([
        
            'nome' => 'required',
            'email' => 'required|email',
            'codiPostal' => 'required' ,
            'localidade' =>'required',
            'pais' => 'required',
            'concelho' =>'required',
            
        ]);*/    



        $postalCode = CodiPostal::create([
            'id_codiPostal'=> "1",
            'codiPostal' => $request->codiPostal,
            'localidade' => $request->localidade,
            'pais' => $request->pais,
            'concelho' => $request->concelho,
            



        ]);
    
      

        $subscriber = Assinante::create([
            
            'nome' => $request->nome,
            'email' => $request->email,
            'id_codiPostal'=> "1",
        ]);

        $subscriber->postalCode()->associate($postalCode);
        $subscriber->save();

        // Faça qualquer outra ação necessária aqui, como exibir uma mensagem de sucesso
        $request->session()->flash('success', 'Subscrito com sucesso!');
       
        return redirect('/assinantes')->back();
    }
}
