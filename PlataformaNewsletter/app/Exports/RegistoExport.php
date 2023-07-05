<?php

namespace App\Exports;

use App\Models\Registro;
use Maatwebsite\Excel\Concerns\FromCollection;

class RegistoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection

    */
    
    public function collection()
    {
        return Registro::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'newsletter_enviadas',
            'tag_utilizadas',
            'newsletter_recebidas',
            'user_id',
            'news_count',
            'newsletter_count',
            'tags_utilizadas_noticias',
            'tags_utilizadas_newsletters',
        ];
    }
}
