<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\News; 

class Newsletter extends Model
{
    use HasFactory;

    use HasFactory;


    public function news()
    {
        return $this->belongsToMany(News::class, 'newsletter_news', 'newsletter_id', 'news_id');
    }
    public function assinantes()
{
    return $this->belongsToMany(Assinante::class, 'newsletter_assinante', 'newsletter_id', 'assinante_id');
}

public function tags()
{
    return $this->belongsToMany(Tag::class, 'newsletter_tags', 'newsletter_id', 'tag_id');
}
public function user()
    {
        return $this->belongsTo(User::class);
    }


}
