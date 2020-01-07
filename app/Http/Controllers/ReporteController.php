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

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**************************/
    /**************************/
    /**************************/
    public function generar()
    {
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
       // $vende = trim($request->get('searchVendedor'));

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

       // $f1=$request->get('FechaInicio');
       // $f2=$request->get('FechaFinal');

        $ventas=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->select('v.idventa','v.idvendedor','v.idcliente','p.nombre','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta','v.total_noce','v.fecha_entrega','v.fecha_pagada')
            ->where(function($query) use ($vende,$f1,$f2){
                if (($f1) & ($f2)) {
                    if (($f1 != "") & ($f2 != "") & ($vende != "")) {
                        return $query->WhereBetween('v.fecha_pagada', [$f1,$f2])
                                        ->where(function($q) use ($vende){
                                            $q->Where('v.idvendedor',$vende);
                                        });
                    }else{
                        if (($f1 != "") & ($f2 != "")){
                            return $query->WhereBetween('v.fecha_pagada', [$f1,$f2]);
                        }else{
                            return $query->whereMonth('v.fecha_pagada', date('m'));
                        }
                    }
                }
                if ($vende) {
                    if ($vende != "") {
                         return $query->where('v.idvendedor',$vende)
                                    ->where(function($q){
                                        $q->whereMonth('v.fecha_pagada', date('m'));
                                    });
                    }
                }
            })
            ->groupBy('v.idventa','v.idvendedor','v.idcliente','p.nombre','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta','v.total_noce','v.fecha_entrega','v.fecha_pagada')
           ->where([
                ['v.estado','=','Pagada']
            ])
            ->orderBy('v.serie_comprobante')
            //->paginate(200);
            ->get();
        $view = \View::make('pdf.reporte',compact('ventas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteArticulo()
    {
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();
        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.stock','c.nombre as categoria','a.estado')
            ->where('a.estado','Activo')
            ->orderBy('categoria')
            ->orderBy('a.nombre')
            ->get();
        $view = \View::make('pdf.reportearticulo',compact('articulos','categorias'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

     public function ReporteArticuloPrecio()
    {
        $categorias=DB::table('tb_categoria')
            ->where([
                    ['condicion','=','1'],
                    ['idcategoria','>','1']
                ])
            ->where('condicion','=','1')
            ->get();
        $articulos=DB::table('tb_articulo as art')
            ->join('tb_categoria as c','art.idcategoria','=','c.idcategoria')
            ->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
            ->select('art.idarticulo','art.nombre','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"),'c.nombre as categoria')
            ->where([
                    ['art.estado','Activo'],
                    ['art.stock','>','0']
                ])
            ->groupBy('art.idarticulo','art.nombre','art.stock', 'categoria')
            ->orderBy('categoria')
            ->orderBy('art.nombre')
            ->get();
        $view = \View::make('pdf.reportearticuloprecio',compact('articulos','categorias'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setpaper('legal', 'portrait');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteNotaCredito($id)
    {
        $ventas=DB::table('tb_venta as v')
            ->join('tb_persona as p','v.idcliente','=','p.idpersona')
            ->join('tb_persona as p2','v.idvendedor','=','p2.idpersona')
            ->select('v.idventa','v.fecha_hora','p.nombre','p2.nombre as vendedor','v.idvendedor','p.direccion','p.tipo_documento','p.num_documento','p.telefono')
            ->where('v.idnoce','=',$id)
            ->first();

        $noces=DB::table('tb_nota_credito')
            ->where('idnoce','=',$id)
            ->first();

        $deta_noces=DB::table('tb_detalle_noce as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('d.idnoce','a.idarticulo','a.nombre as articulo', 'd.cantidad','d.precio_venta')
            ->where('d.idnoce','=',$id)
            ->get();

        $view = \View::make('pdf.reportenotacredito',compact('ventas','noces','deta_noces'))->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('landscape');
        return $pdf->stream('informe'.'.pdf');
    }
    public function ReporteFactura($id)
    {
        $venta=DB::table('tb_venta as v')
            ->join('tb_persona as p','v.idcliente','=','p.idpersona')
            ->join('tb_persona as p2','v.idvendedor','=','p2.idpersona')
            ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','p2.nombre as vendedor','v.idvendedor','p.direccion','p.tipo_documento','p.num_documento','p.telefono','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('tb_detalle_venta as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.idarticulo','a.nombre as articulo', 'd.cantidad', 'd.descuento','d.precio_venta')
            ->where('d.idventa','=',$id)
            ->get();
        $view = \View::make('pdf.reportefactura',compact('venta','detalles'))->render();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('landscape');
        return $pdf->stream('informe'.'.pdf');
    }
}
