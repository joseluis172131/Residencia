<?php

namespace App\Http\Controllers;

use App\Models\Almacen_AdminModel;
use App\Models\Ingenieria_AdminModel;
use App\Models\Oficina_AdminModel;
use Illuminate\Http\Request;
use App\Models\Herramienta;
//use PDF;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function generatePDF()
    {
        $datos = Herramienta::all();

        $pdf = PDF::loadView('report', compact('datos'));

        return $pdf->download('reporte de almacen de paileria.pdf');
    }

    public function generarPDF()
    {
        $datos = Oficina_AdminModel::all();

        $pdf = PDF::loadView('report', compact('datos'));

        return $pdf->download('reporte de almacen de Oficina.pdf');
    }

    public function InfomePDF()
    {
        $datos = Ingenieria_AdminModel::all();

        $pdf = PDF::loadView('report', compact('datos'));

        return $pdf->download('reporte de almacen de Ingenieria.pdf');
    }

    public function infoPDF()
    {
        $datos = Almacen_AdminModel::all();

        $pdf = PDF::loadView('report', compact('datos'));

        return $pdf->download('reporte de Almacen.pdf');
    }
}
