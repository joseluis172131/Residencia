<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class VistasPersonalController extends Controller
{
    public function verOficina(){
        $datos = DB::select("SELECT * FROM oficina_administrativa");
        return view('personalVistas/oficinaPersonal', compact('datos'));
    }

    public function verPaileria(){
        $datos = DB::select("SELECT * FROM paileria");
        return view('personalVistas/paileriaPersonal', compact('datos'));
    }


    public function verIngenieria(){
        $datos = DB::select("SELECT * FROM ingenieria");
        return view('personalVistas/ingenieriaPersonal', compact('datos'));
    }

    public function verAlmacen(){
        $datos = DB::select("SELECT * FROM almacen");
        return view('personalVistas/almacenPersonal', compact('datos'));
    }
    
    
}
