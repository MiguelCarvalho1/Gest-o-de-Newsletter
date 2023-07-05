<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistoExport;
use Barryvdh\DomPDF\Facade\PDF;


class RegistosController extends Controller
{

/*
A função index() recupera todos os registros da tabela "registros" e os passa para a view "registros" para exibição na tabela.

A função exportToPDF() exporta os registros para um arquivo PDF. Ela carrega a view "registros_pdf" com os dados dos registros e gera o PDF 
utilizando a biblioteca dompdf. O arquivo PDF é então baixado pelo utilizador.

A função exportXlsx() exporta os registros para um arquivo XLSX. Ela utiliza a classe RegistroExport, que implementa a interface FromCollection da 
biblioteca maatwebsite/excel, para criar o arquivo XLSX. O arquivo é baixado pelo utilizador
*/


    public function index()
    {
        $registros = Registro::all();

        return view('registos', compact('registros'));
    }


    public function exportToPDF()
    {
        $registros = Registro::all();

        $pdf = PDF::loadView('registos_pdf', compact('registros'));

        return $pdf->download('registos.pdf');
    }

    public function exportXlsx()
    {
        return Excel::download(new RegistoExport, 'registos.xlsx');
    }
}
