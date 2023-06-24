<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('/tags/index', compact('tags'));
    }

    public function showCreateForm()
    {
        return view('/tags/criar');
    }



    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:tags|max:255',
        ]);

        Tag::create($request->all());

        return redirect(('/tags'))->with('success', 'Tag criada com sucesso.');
    }
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('/tags/edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nome' => 'required',
       
        ]);

        $tag =  Tag::findOrFail($id)->update($data);
       

        return redirect('/tags')->with('success', 'Tag atualizada com sucesso.');
    }
    public function destroy($id)
    {
       $tag = Tag::findOrFail($id);
       $tag->delete();

        return redirect('/tags')->with('success', 'Tag eliminda com sucesso.');
    }
        
}
