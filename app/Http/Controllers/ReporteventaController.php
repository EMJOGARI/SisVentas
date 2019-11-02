<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use SisVentas\Http\Requests;
use SisVentas\Articulo;
use SisVentas\Http\Requests\ArticuloFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection as Collection;


class ReporteventaController extends Controller
{
   /************************/
    /** REPORTES DE VENTAS **/
    /************************/
    public function reporte_venta_cliente(Request $request)
    {

       /* $second=DB::table('tb_nota_debito as nd')
             ->rightJoin('tb_venta as v', 'v.idventa','nd.idventa');

             04248656994 7937776 Banesco

        $first=DB::table('tb_venta as v')
            ->leftJoin('tb_nota_debito as nd','nd.idventa','v.idventa')
            ->unionAll($second)
            ->get();
        dd($first);*/
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
                ->where('v.estado','<>','Anulada')
                ->where('v.estado','<>','Eliminada')
                ->orderBy('idventa','desc')
                ->paginate(200);

            $sum_total_venta = 0;
            foreach ($ventas as $venta) {
                $sum_total_venta += $venta->total_venta;
            }
        return view('reporte.venta.venta-cliente.index',["ventas"=>$ventas,"clientes"=>$clientes,"sum_total_venta"=>$sum_total_venta]);
    }

    public function reporte_venta_vendedor(Request $request)
    {
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
        $vende = trim($request->get('searchVendedor'));

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
                ->where(function($query) use ($vende,$muni,$f1,$f2){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($vende != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                            ->where(function($q) use ($vende,$muni){
                                                $q->Where('v.idvendedor',$vende);
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
                })
                ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.idcliente','p2.nombre','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->where('v.estado','<>','Anulada')
                ->where('v.estado','<>','Eliminada')
                ->orderBy('idventa','desc')
                ->paginate(200);

            $sum_total_venta = 0;
            foreach ($ventas as $venta) {
                $sum_total_venta += $venta->total_venta;
            }
        return view('reporte.venta.venta-vendedor.index',["ventas"=>$ventas,"vendedores"=>$vendedores,"sum_total_venta"=>$sum_total_venta]);
    }
    public function reporte_venta_categoria(Request $request)
    {
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
        $vende = trim($request->get('searchVendedor'));

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

            $ventas=DB::table('tb_venta as v')
                ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
                ->join('tb_persona as p','p.idpersona','=','v.idvendedor')
                ->join('tb_articulo as a','a.idarticulo','dv.idarticulo')
                ->join('tb_categoria as c','c.idcategoria','a.idcategoria')
                ->select('v.idvendedor','p.nombre as vendedor','c.nombre as categorias',
                            DB::raw("SUM(dv.cantidad) AS cantidad"),
                            DB::raw("SUM(dv.cantidad * dv.precio_venta) AS neto")
                        )
                ->where(function($query) use ($vende,$f1,$f2){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($vende != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                            ->Where(function($q) use ($vende){
                                                $q->Where('p.idpersona',$vende);
                                            });
                        }
                    }else{
                        if ($vende != "") {
                            return $query->where('p.idpersona',$vende)
                                        ->where(function($q){
                                            $q->whereMonth('v.fecha_hora', date('m'));
                                        });
                        }else{
                            return $query->whereMonth('v.fecha_hora', date('m'));
                        }
                    }
                })
                ->where('v.estado','<>','Anulada')
                ->where('v.estado','<>','Eliminada')
                ->groupBy('v.idvendedor','p.nombre','c.nombre')
                ->orderBy('v.idvendedor')
                ->orderBy('c.nombre')
                ->get();
            $sum_total = 0;
            $sum_neto = 0;
            foreach ($ventas as $venta) {
                $sum_total += $venta->cantidad;
                $sum_neto += $venta->neto;
            }
        return view('reporte.venta.venta-categoria.index',["ventas"=>$ventas,"vendedores"=>$vendedores,"sum_total"=>$sum_total,"sum_neto"=>$sum_neto]);
    }

     public function reporte_factura_anulada(Request $request)
    {
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
        $vende = trim($request->get('searchVendedor'));

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
                ->where(function($query) use ($vende,$muni,$f1,$f2){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($vende != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                            ->where(function($q) use ($vende,$muni){
                                                $q->Where('v.idvendedor',$vende);
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
                })
                ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.idcliente','p2.nombre','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->where('v.estado','Anulada')
                ->orderBy('idventa','desc')
                ->paginate(200);

            $sum_total_venta = 0;
            foreach ($ventas as $venta) {
                $sum_total_venta += $venta->total_venta;
            }
        return view('reporte.venta.facturas-anuladas.index',["ventas"=>$ventas,"vendedores"=>$vendedores,"sum_total_venta"=>$sum_total_venta]);
    }
}
