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
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
        $vende = trim($request->get('searchVendedor'));

        $clientes=DB::table('tb_persona')->orderBy('idpersona')->get();
        $clien = $request->get('cliente');

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

        $muni = $request->get('municipio');

            $ventas=DB::table('tb_venta as v')
                ->join('tb_persona as p','v.idcliente','=','p.idpersona')
                ->join('tb_persona as p2','v.idvendedor','=','p2.idpersona')
                ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
                ->select('v.idventa','v.idvendedor','v.fecha_hora','v.idcliente','p.nombre','p2.nombre as vendedor','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->where(function($query) use ($clien,$muni,$f1,$f2,$vende){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($clien != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                            ->where(function($q) use ($clien,$muni,$vende){
                                                $q->orWhere('p.idpersona',$clien)
                                                ->orWhere('p.municipio',$muni)
                                                ->orWhere('p.idpersona',$vende);
                                            });
                        }else{
                            if (($f1 != "") & ($f2 != "")){
                                return $query->WhereBetween('v.fecha_hora', [$f1,$f2]);
                            }else{
                                return $query->whereMonth('v.fecha_hora', date('m'));
                            }
                        }
                    }
                    if ($vende) {
                        if ($vende != "") {
                            return $query->where('v.idvendedor',$vende)
                                        ->where(function($q){
                                            $q->whereMonth('v.fecha_hora', date('m'));
                            });
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
            //dd($ventas);
        return view('reporte.ingreso.ingreso-cliente.index',compact('ventas','clientes','sum_total_venta','vendedores'));
    }
   
    public function reporte_analisis_vencimiento(Request $request){
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
        $vende = $request->get('searchVendedor');

        $fact=trim($request->get('searchText'));

        $ventas=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_persona as p2','p2.idpersona','v.idvendedor')
            ->join('tb_detalle_venta as dv','v.idventa','dv.idventa')
            ->select('v.idcliente','v.idvendedor','v.idventa','v.fecha_hora','p.nombre','p2.nombre as vendedor','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta',DB::raw("(current_date - v.fecha_hora) AS dia"))
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
            ->groupBy('v.idcliente','v.idvendedor','v.idventa','v.fecha_hora','p.nombre','p2.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->orderBy('idventa','desc')
            ->paginate(30);
            $mar_1 = 0; $mar_2 = 0; $mar_3 = 0;
            foreach ($ventas as $ven){
                if(($ven->dia === 0) & ($ven->dia <= 3)){
                    $mar_1 += $ven->total_venta;
                }else{
                    if(($ven->dia >= 4) && ($ven->dia <= 7)){
                        $mar_2 += $ven->total_venta;
                    }else{
                        $mar_3 += $ven->total_venta;
                    }
                }
            }
            //dd($mar_1,$mar_2,$mar_3);
        return view('reporte.ingreso.analisis-vencimiento.index',compact('ventas','fact','vendedores','mar_1','mar_2','mar_3'));
   }

} /* FIN REPORTE INGRESO CONTROLLER*/
