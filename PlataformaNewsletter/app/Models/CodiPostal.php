<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodiPostal extends Model
{
    use HasFactory;

    protected $table = 'codipostal';

    protected $fillable = ['localidade', 'concelho', 'pais', 'codiPostal'];


    public function assinantes()
    {
        return $this->hasMany(Assinante::class, 'id_codiPostal');
    }
}
