<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    public function news()
    {
        return $this->belongsToMany(News::class, 'newsletter_news', 'newsletter_id', 'news_id');
    }
}
