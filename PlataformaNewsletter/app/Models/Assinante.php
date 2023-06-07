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

    
}
