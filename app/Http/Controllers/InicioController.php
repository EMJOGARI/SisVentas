<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Articulo;
use SisVentas\Persona;
use DB;

class InicioController extends Controller
{
   
    public function index()
    {
        $personas=DB::table('tb_persona') 
            ->select(DB::raw("count(tipo_persona) AS personas"))                     
            ->where('tipo_persona','Cliente')            
            ->get();

        $ingresos=DB::table('tb_ingreso') 
            ->select(DB::raw("count(estado) AS ingresos"))                     
            ->where('estado','A')            
            ->get();

        $ventas=DB::table('tb_venta') 
            ->select(DB::raw("count(estado) AS ventas"))                     
            ->where('estado','A')            
            ->get();

        $articulos=DB::table('tb_articulo') 
            ->select(DB::raw("sum(stock) AS total"))                     
            ->where('estado','Activo')            
            ->get();        

        return view('principal/index', ["personas"=>$personas,"ingresos"=>$ingresos,"ventas"=>$ventas,"articulos"=>$articulos]); 
    }
    
}
