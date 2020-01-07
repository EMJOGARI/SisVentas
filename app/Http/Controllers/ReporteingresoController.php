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

            $ventas=DB::table('tb_venta as v')
                ->join('tb_persona as p','v.idcliente','=','p.idpersona')
                ->join('tb_persona as p2','v.idvendedor','=','p2.idpersona')
                ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
                ->select('v.idventa','v.idvendedor','v.fecha_hora','v.fecha_entrega','v.fecha_pagada','v.idcliente','p.nombre','p2.nombre as vendedor','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta','v.total_noce','v.dias_pago')
                ->where(function($query) use ($clien,$f1,$f2,$vende){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($vende != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                            ->where(function($q) use ($clien,$vende){
                                                $q->orWhere('v.idvendedor',$vende);
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
                })
                ->groupBy('v.idventa','v.fecha_hora','v.fecha_entrega','v.fecha_pagada','p.nombre','v.idcliente','p2.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta','v.total_noce','v.dias_pago')
                ->where('v.estado','Pagada')
                ->orderBy('idventa','desc')
                ->paginate(200);

            $sum_total_venta = 0;
            foreach ($ventas as $venta) {
                $sum_total_venta += $venta->total_venta - $venta->total_noce;
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
            ->select('v.idcliente','v.idvendedor','v.idventa','v.fecha_hora','v.fecha_entrega','p.nombre','p2.nombre as vendedor','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta','v.total_noce')
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
            ->groupBy('v.idcliente','v.idvendedor','v.idventa','v.fecha_hora','v.fecha_entrega','p.nombre','p2.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta','v.total_noce')
            ->orderBy('idventa','desc')
            ->paginate(30);
            $mar_1 = 0; $mar_2 = 0; $mar_3 = 0;
            foreach ($ventas as $ven){

                $StarDate = strtotime($ven->fecha_entrega);
                $EndDate = strtotime(date('d-m-Y'));
                $cont = 0;
                for($StarDate;$StarDate<=$EndDate;$StarDate=strtotime('+1 day ' . date('Y-m-d',$StarDate)))
                {
                    if((strcmp(date('D',$StarDate),'Sun')!=0) and (strcmp(date('D',$StarDate),'Sat')!=0))
                    {
                        $cont = $cont + 1;
                    }
                }

                if(($cont === 1) & ($cont <= 4)){
                    $mar_1 += $ven->total_venta - $ven->total_noce;
                }else{
                    if(($cont >= 5) && ($cont <= 6)){
                        $mar_2 += $ven->total_venta - $ven->total_noce;
                    }else{
                        $mar_3 += $ven->total_venta - $ven->total_noce;
                    }
                }
            }
            //dd($mar_1,$mar_2,$mar_3);
        return view('reporte.ingreso.analisis-vencimiento.index',compact('ventas','fact','vendedores','mar_1','mar_2','mar_3','cont'));
   }

} /* FIN REPORTE INGRESO CONTROLLER*/
