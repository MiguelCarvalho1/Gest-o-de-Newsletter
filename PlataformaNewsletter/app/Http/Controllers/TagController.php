<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Registro;

use App\Exports\TagsExport;
use App\Exports\TagsExportPDF;
use Barryvdh\DomPDF\Facade\PDF;
use Maatwebsite\Excel\Facades\Excel;

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
    public function export($format)
    { 
        $tags = Tag::all();
    
        if (in_array($format, ['xlsx', 'pdf'])) {
            if ($format === 'pdf') {
                $pdf = PDF::loadView('tags.tags-pdf', compact('tags'));
                $pdf->getDomPDF()->set_option('font_dir', storage_path('fonts/'));
                $pdf->getDomPDF()->set_option('font_cache', storage_path('fonts/'));
                return $pdf->download('Tags.pdf');
            } else {
                // Lógica para exportar em XLSX
                return Excel::download(new TagsExport, 'Tags.'.$format);
            }
        }
    }

    


    
public function contarAssinantesPorTag()
{
    // Obtenha todas as tags
    $tags = Tag::all();

    // Array para armazenar os contadores de assinantes por tag
    $contadores = [];

    // Percorra cada tag
    foreach ($tags as $tag) {
        // Obtenha o número de assinantes associados à tag atual
        $count = $tag->assinantes()->count();

        // Armazene o contador no array, usando o ID da tag como chave
        $contadores[$tag->id] = $count;
    }

    // Faça algo com o array de contadores (exibir, retornar, etc.)
    // ...

    // Exemplo de exibição dos contadores
    foreach ($contadores as $tagId => $count) {
        echo "Tag ID: $tagId, Assinantes: $count";
    }
}

public function countTagUsage()
{
    $tags = Tag::withCount('news')->get();

    foreach ($tags as $tag) {
        $tag->registros()->updateOrCreate([], ['tag_utilizadas' => $tag->news_count]);
    }

    return $tags;
}
}

