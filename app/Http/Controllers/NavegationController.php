<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavegationController extends Controller
{
    public function vistapaileria(){
        return view('/');
    }
}
