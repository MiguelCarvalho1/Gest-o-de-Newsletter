<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';

    protected $fillable = [
        'news_id',
        'url',
        'nome',
        // Add other fillable fields if needed
    ];
    public function news()
    {
        return $this->belongsTo(News::class);
    }
    use HasFactory;
}
