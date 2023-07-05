<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'newsletter_enviadas',
        'tag_utilizadas',
        'newsletter_recebidas',
        'news_count',
        'tags_utilizadas_newsletters',
        'tags_utilizadas_noticias'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
