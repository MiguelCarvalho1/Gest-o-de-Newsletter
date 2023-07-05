<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function noticias()
{
    return $this->belongsToMany(News::class,'news_tags', 'news_id', 'tag_id');
}
public function newsletters()
{
    return $this->belongsToMany(Newsletter::class, 'newsletter_tags', 'tag_id', 'newsletter_id');
}

public function assinantes()
{
    return $this->belongsToMany(Assinante::class,'assinante_tags', 'assinante_id', 'tag_id' );
}
}
