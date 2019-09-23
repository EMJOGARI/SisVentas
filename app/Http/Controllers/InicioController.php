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
/***********************/
/* RANKING DE CLIENTES */
/***********************/
        $ranking=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->select('v.idcliente','p.nombre',DB::raw("SUM(v.total_venta) as total"))
            ->whereMonth('v.fecha_hora', date('m'))
            ->where('v.estado','<>','Anulada')
            ->groupBy('v.idcliente','p.nombre')
            ->orderBy('total','desc')
            ->get();
            $sum_total = 0;
            $k =0;
            foreach ($ranking as $rank) {
                $sum_total += $rank->total;
            }
/*************************/
/* RANKING POR MUNICIPIO */
/*************************/
        $ranking_municipio=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_persona as p2','p2.idpersona','v.idvendedor')
            ->select('p.municipio','p2.nombre',DB::raw("SUM(v.total_venta) as total"))
            ->whereMonth('v.fecha_hora', date('m'))
            ->where('v.estado','<>','Anulada')
            ->groupBy('p.municipio','p2.nombre')
            ->orderBy('total','desc')
            ->get();
           // dd($ranking_municipio);
            $sum_total_municipio = 0;
            $m =0;
            foreach ($ranking_municipio as $rank) {
                $sum_total_municipio += $rank->total;
            }
        return view('principal/index', ["personas"=>$personas,"ingresos"=>$ingresos,"ventas"=>$ventas,"articulos"=>$articulos,"ranking"=>$ranking,"sum_total"=>$sum_total,"k"=>$k,"m"=>$m,"ranking_municipio"=>$ranking_municipio,"sum_total_municipio"=>$sum_total_municipio]);
    }

}
