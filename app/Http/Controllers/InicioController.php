<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Articulo;
use SisVentas\Persona;
use SisVentas\Charts\ReporteChart;
use DB;

class InicioController extends Controller
{

    public function index()
    {
        $clientes=DB::table('tb_persona')
            ->select(DB::raw("count(tipo_persona) AS personas"))
            ->where('tipo_persona','Cliente')
            ->get();

        $cli_new=DB::table('tb_persona')
            ->select(DB::raw("count(tipo_persona) AS personas"))
            ->where('tipo_persona','Cliente')
            ->whereMonth('fecha_creacion',date('m'))
            ->get();
/***********************/            
/* ESTADISTICA POR AÑO */
/***********************/
        $ingresos=DB::table('tb_ingreso')
            ->select(DB::raw("count(estado) AS ingresos"))
            ->where('estado','A')
            ->get();

        $ingreso_total=DB::table('tb_ingreso')
            ->select(DB::raw("sum(total_compra) AS compras"))
            ->whereYear('fecha_hora',date('Y'))
            ->where('estado','A')
            ->get();        

        $ventas=DB::table('tb_venta')
            ->select(DB::raw("count(estado) AS ventas"))
            ->where([
                    ['estado','<>','Anulada'],
                    ['estado','<>','Eliminada']
                ])
            ->get();

        $venta_total=DB::table('tb_venta')
            ->select(DB::raw("sum(total_venta) AS ventas"))
            ->where([
                    ['estado','<>','Anulada'],
                    ['estado','<>','Eliminada']
                ])
            ->whereYear('fecha_hora',date('Y'))
            ->get();
/***********************/            
/* ESTADISTICA POR MES */
/***********************/
         $ingresos_mes=DB::table('tb_ingreso')
            ->select(DB::raw("count(estado) AS ingresos"), DB::raw("to_char(fecha_hora, 'TMMonth') as nombre"))
            ->whereMonth('fecha_hora',date('m'))
            ->groupBy(DB::raw("EXTRACT(MONTH FROM fecha_hora)"),'nombre')
            ->where('estado','A')
            ->get();

        $ingreso_total_mes=DB::table('tb_ingreso')
            ->select(DB::raw("sum(total_compra) AS compras"))
            ->whereMonth('fecha_hora',date('m'))
            ->where('estado','A')
            ->get();        

        $ventas_mes=DB::table('tb_venta')
            ->select(DB::raw("count(estado) AS ventas"),DB::raw("to_char(fecha_hora, 'TMMonth') as nombre"))
            ->whereMonth('fecha_hora',date('m'))
            ->where([
                    ['estado','<>','Anulada'],
                    ['estado','<>','Eliminada']
                ])
            ->groupBy(DB::raw("EXTRACT(MONTH FROM fecha_hora)"),'nombre')
            ->get();

        $cantidad_mes=DB::table('tb_venta as v')
            ->join('tb_detalle_venta as dv','dv.idventa','v.idventa')
            ->select(DB::raw("sum(dv.cantidad) AS cantidad"))
            ->whereMonth('v.fecha_hora',date('m'))
            ->where([
                    ['v.estado','<>','Anulada'],
                    ['v.estado','<>','Eliminada']
                ])            
            ->get();

        $venta_total_mes=DB::table('tb_venta')
            ->select(DB::raw("sum(total_venta) AS ventas"))
            ->whereMonth('fecha_hora',date('m'))
            ->where([
                    ['estado','<>','Anulada'],
                    ['estado','<>','Eliminada']
                ])            
            ->get();

        $articulos=DB::table('tb_articulo')
            ->select(DB::raw("sum(stock) AS total"))
            ->where('estado','Activo')
            ->get();

        $articulos_neto=DB::table('tb_articulo as a')
            ->join('tb_detalle_ingreso as di','di.idarticulo','a.idarticulo')
            ->select('a.idarticulo','a.stock',DB::raw("MAX(di.precio_venta * a.stock) AS total"))
            ->where([
                    ['a.estado','Activo'],
                    ['a.stock','>',0]
                ])
            ->groupBy('a.idarticulo','a.stock')
            ->orderBy('a.idarticulo')
            ->get();

        $neto_inventario = 0;
        foreach ($articulos_neto as $neto) {
            $neto_inventario += $neto->total;
        }
/***********************/
/* RANKING DE CLIENTES */
/***********************/
        $ranking=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->select('v.idcliente','p.nombre',DB::raw("SUM(v.total_venta) as total"))
            ->whereMonth('v.fecha_hora', date('m'))
            ->where([
                    ['v.estado','<>','Anulada'],
                    ['v.estado','<>','Eliminada']
                ])
            ->groupBy('v.idcliente','p.nombre')
            ->orderBy('total','desc')
            ->paginate(10);

            $k =0;

/*************************/
/* RANKING POR MUNICIPIO */
/*************************/
        $ranking_municipio=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->select('p.municipio',DB::raw("SUM(v.total_venta) as total"))
            ->whereMonth('v.fecha_hora', date('m'))
            ->where([
                    ['v.estado','<>','Anulada'],
                    ['v.estado','<>','Eliminada']
                ])
            ->groupBy('p.municipio')
            ->orderBy('total','desc')
            ->get();

            $sum_total_municipio = 0;
            $m =0;
            foreach ($ranking_municipio as $rank) {
                $sum_total_municipio += $rank->total;
            }
/************************/
/******* GRAFICOS *******/
/************************/

    $egreso = DB::table('tb_venta')
            ->select(
                DB::raw("SUM(total_venta) as total"),
                DB::raw("EXTRACT(MONTH FROM fecha_hora) as mes"), //obtiene solo el numero del mes
                DB::raw("to_char(fecha_hora, 'TMMonth') as nombre") // obtiene el nombre del mes
            )
            ->where('estado','Pagada')
            ->whereYear('fecha_hora',date('Y'))
            ->groupBy(DB::raw("EXTRACT(MONTH FROM fecha_hora)"),'nombre')
            ->orderBy('mes')
            ->get();

    $ingreso = DB::table('tb_ingreso')
            ->select(
                DB::raw("SUM(total_compra) as total"),
                DB::raw("EXTRACT(MONTH FROM fecha_hora) as mes"),
                DB::raw("to_char(fecha_hora, 'TMMonth') as nombre")
            )
            ->where('estado','A')
            ->whereYear('fecha_hora',date('Y'))
            ->groupBy(DB::raw("EXTRACT(MONTH FROM fecha_hora)"),'nombre')
            ->orderBy('mes')
            ->get();
//dd($ingreso);
    $data_pag = [];
    $data_pen = [];
    $mes = [];
    foreach($egreso as $ven){
        $mes[] = $ven->nombre;
        $data_pag[] = $ven->total;
    }
    foreach($ingreso as $comp){
        $data_pen[] = $comp->total;
    }

    $chart = new ReporteChart;
    //$chart->title('Compras & Ventas '.date('Y'), 30, "rgba(51, 51, 51, 1.0)", true, 'Helvetica Neue');
    //$chart->displaylegend(false);
    $chart->labels($mes);

    $chart->dataset('Compras', 'bar', $data_pen)
        ->color("rgba(243, 156, 18, 1.0)")
        ->backgroundcolor("rgba(243, 156, 18, 0.7)");

    $chart->dataset('Ventas', 'bar', $data_pag)
        ->color("rgba(0, 166, 90, 1.0)")
        ->backgroundcolor("rgba(0, 166, 90, 0.7)");


/************************/
/************************/
        return view('principal/index', compact('chart','clientes','cli_new','ingresos','ingreso_total','ventas','venta_total','articulos','neto_inventario','ranking','k','m','ranking_municipio','sum_total_municipio','ingresos_mes','ingreso_total_mes','ventas_mes','cantidad_mes','venta_total_mes'));
    }
}
