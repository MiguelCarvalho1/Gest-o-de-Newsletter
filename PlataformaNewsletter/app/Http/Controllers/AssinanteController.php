<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssinanteController extends Controller
{
    public function index()
    {
        // Retorna todos os assinantes
        $assinantes = Assinante::all();
        return view('assinantes.index', compact('assinantes'));
    }

    public function create()
    {
        // Retorna a view para criar um novo assinante
        return view('assinante_create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|email|unique:assinantes',
            'id_codiPostal' => 'required|exists:codiPostal,id'
        ]);

        // Cria um novo assinante no banco de dados
        $assinante = Assinante::create($validatedData);

        // Redireciona para a página de exibição do assinante criado
        return redirect()->route('/', $assinante->id);
    }

    public function show($id)
    {
        // Retorna a página de exibição de um assinante específico
        $assinante = Assinante::findOrFail($id);
        return view('assinantes.show', compact('assinante'));
    }

    public function edit($id)
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
        return redirect()->route('assinantes.show', $assinante->id);
    }

    public function destroy($id)
    {
        // Exclui um assinante do banco de dados
        $assinante = Assinante::findOrFail($id);
        $assinante->delete();

        // Redireciona para a página inicial dos assinantes
        return redirect()->route('assinantes.index');
    }
}
