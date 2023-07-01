<?php

namespace App\Exports;

use App\Models\Tag;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TagsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Tag::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            
        ];
    }
}