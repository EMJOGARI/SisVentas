<?php

namespace PcArts\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generar()
    {
        $articulos=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.costo','c.nombre as categoria','a.estado')
            ->get();
        $view = \View::make('pdf.reporte',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

  /*  public function ReporteCategoria()
    {
        $categorias=DB::table('categoria')
        	->get();
    }*/


    public function ReporteArticulo()
    {
        $articulos=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.costo','c.nombre as categoria','a.estado')
            ->get();
        $view = \View::make('pdf.reporte',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');

    }

}
