<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assinante extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'id_codiPostal'];

    public function postalCode()
    {
        return $this->belongsTo(CodiPostal::class, 'id_codiPostal');
    }
    public function search($keyword)
    {
        $keyword = 'termo de busca'; // Substitua pelo termo de busca desejado
        $assinantes = Assinante::where('nome', 'REGEXP', $keyword)->get();

        // Faça o que deseja com os resultados da busca

        return view('assinantes.search', compact('assinantes'));
    }
    public function newsletters()
{
    return $this->belongsToMany(Newsletter::class, 'newsletter_assinante', 'assinante_id', 'newsletter_id');
}

public function tags()
{
    return $this->belongsToMany(Tag::class, 'assinante_tags', 'assinante_id', 'tag_id');
}


    
}
