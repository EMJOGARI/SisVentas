<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Venta;
use SisVentas\DetalleVenta;
use SisVentas\Articulo;
use SisVentas\NotaDebito;
use SisVentas\DetalleNotaDebito;
use SisVentas\Http\Requests\VentaFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class ReporteingresoController extends Controller
{
    public function reporte_ingreso_cliente(Request $request){

        $clientes=DB::table('tb_persona')->orderBy('idpersona')->get();

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

        $clien = $request->get('cliente');
        $muni = $request->get('municipio');

            $ventas=DB::table('tb_venta as v')
                ->join('tb_persona as p','v.idcliente','=','p.idpersona')
                ->join('tb_persona as p2','v.idvendedor','=','p2.idpersona')
                ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
                ->select('v.idventa','v.idvendedor','v.fecha_hora','v.idcliente','p.nombre','p2.nombre as vendedor','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->where(function($query) use ($clien,$muni,$f1,$f2){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($clien != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                            ->where(function($q) use ($clien,$muni){
                                                $q->orWhere('p.idpersona',$clien)
                                                ->orWhere('p.municipio',$muni);
                                            });
                        }else{
                            if (($f1 != "") & ($f2 != "")){
                                return $query->WhereBetween('v.fecha_hora', [$f1,$f2]);
                            }else{
                                return $query->whereMonth('v.fecha_hora', date('m'));
                            }
                        }
                    }
                    if ($clien) {
                        if ($clien != "") {
                             return $query->where('p.idpersona',$clien)
                                        /*->where(function($q){
                                            $q->whereMonth('v.fecha_hora', date('m'));
                                        })*/;
                        }
                    }
                    if ($muni) {
                        if ($muni != "") {
                             return $query->where('p.municipio',$muni);
                        }
                    }
                })
                ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.idcliente','p2.nombre','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->where('v.estado','Pagada')
                ->orderBy('idventa','desc')
                ->paginate(200);

            $sum_total_venta = 0;
            foreach ($ventas as $venta) {
                $sum_total_venta += $venta->total_venta;
            }
        return view('reporte.ingreso.ingreso-cliente.index',["ventas"=>$ventas,"clientes"=>$clientes,"sum_total_venta"=>$sum_total_venta]);
    }
    public function reporte_analisis_vencimiento(Request $request){
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
        $vende = $request->get('searchVendedor');

        $fact=trim($request->get('searchText'));
        $ventas=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_persona as p2','p2.idpersona','v.idvendedor')
            ->join('tb_detalle_venta as dv','v.idventa','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','p2.nombre as vendedor','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta',DB::raw("(current_date - v.fecha_hora) AS dia"))
            ->where(function($query) use ($fact,$vende){
                if($fact){
                    if ($fact != "") {
                        return $query->where('v.serie_comprobante',$fact);
                    }
                }
                if ($vende) {
                    if ($vende != "") {
                         return $query->where('v.idvendedor',$vende);
                    }
                }
            })
            ->where('v.estado','Pendiente')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','p2.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->orderBy('idventa','desc')
            ->paginate(20);
            $tiempo = 0;
            foreach ($ventas as $ven) {
                $tiempo=(strtotime(date('d-m-Y'))-strtotime($ven->fecha_hora))/86400;
            }
            //dd($ventas);
        return view('reporte.ingreso.analisis-vencimiento.index',["ventas"=>$ventas,"searchText"=>$fact,"vendedores"=>$vendedores,"tiempo"=>$tiempo]);
   }
} /* FIN REPORTE INGRESO CONTROLLER*/
