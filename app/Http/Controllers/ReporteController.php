<?php

namespace PcArts\Http\Controllers;

use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generar()
    {
        return view('reporte');
    }

}
