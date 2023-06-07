<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'pais';

    protected $fillable = ['nome'];


    public function assinantes()
    {
        return $this->hasMany(Paises::class, 'id');
    }
}
