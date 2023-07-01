<?php

namespace App\Exports;

use App\Models\Assinante;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssinanteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Assinante::all();
    }
}
