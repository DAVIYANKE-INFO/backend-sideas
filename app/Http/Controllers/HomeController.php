<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    public function generatePDF()
    {

        $data = ['title' => 'PAPELETA DE SALIDA'];
        $pdf = PDF::loadView('myPDF', $data);
        //return view('myPDF');
        return $pdf->download('SALIDA.pdf');

    }
}