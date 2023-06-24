<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function newsletters()
    {
        return $this->belongsToMany(Newsletter::class, 'newsletter_news', 'news_id', 'newsletter_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function tags()
{
    return $this->belongsToMany(Tag::class, 'news_tags', 'news_id', 'tag_id');
}

}
