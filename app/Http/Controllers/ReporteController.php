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
    public function reporte_almacen(Request $request)
    {
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();

        $codigo =$request->get('searchText');
        $stock = trim($request->get('searchList'));
        $cat = trim($request->get('searchCategoria'));

        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
            ->join('tb_detalle_ingreso as di','a.idarticulo','=','di.idarticulo')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.estado',
                DB::raw("MAX(di.precio_venta) AS precio_venta"),
                DB::raw("MAX(di.precio_compra) AS precio_compra")
            )
            ->groupBy('a.idarticulo','a.nombre','a.codigo','a.stock','a.estado','c.nombre')
            ->where(function($query) use ($codigo, $stock, $cat){
                if($codigo){
                    if ($codigo != "") {
                        return $query->Where('a.codigo',$codigo);
                    }
                }

                if($stock){
                    if ($stock != "") {
                        if ($stock == 2) {
                            return $query->where('stock','<=','0');
                        }else{
                            if ($stock == 1 && $cat != ""){
                                 return $query->where('stock','>','0')
                                            ->where(function($q) use ($cat){
                                                $q->where('c.idcategoria',$cat);
                                            });
                            }else{
                                 return $query->where('stock','>','0');
                            }
                        }
                    }
                }

                if($cat){
                    if ($cat != "") {
                        return $query->orWhere('c.idcategoria',$cat);
                    }
                }
            })
            ->where('a.estado','Activo')
            ->orderBy('categoria')
            ->orderBy('a.nombre')
            ->paginate(50);

            $sum_stock = 0;
            foreach ($articulos as $art) {
                $sum_stock += $art->stock;
            }

        return view('reporte.almacen.listado-producto.index',["articulos"=>$articulos,"searchText"=>$codigo,"searchList"=>$stock,"categorias"=>$categorias,"sum_stock"=>$sum_stock]);
    }
    public function reporte_almacen_utilidad(Request $request)
    {
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();

        $codigo = $request->get('searchText');
        $cat = trim($request->get('searchCategoria'));

        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
            ->join('tb_detalle_ingreso as di','a.idarticulo','=','di.idarticulo')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.estado',
                DB::raw("MAX(di.precio_venta) AS precio_venta"),
                DB::raw("MAX(di.precio_compra) AS precio_compra")
            )
            ->where(function($query) use ($codigo, $cat){
                if($codigo){
                    if ($codigo != "") {
                        return $query->where('a.codigo',$codigo);
                    }
                }
                if($cat){
                    if ($cat != "") {
                        return $query->where('c.idcategoria',$cat);
                    }
                }
            })
            ->where('stock','>','0')
            ->where('a.estado','Activo')
            ->groupBy('a.idarticulo','a.nombre','a.codigo','a.stock','a.estado','c.nombre')
            ->orderBy('categoria')
            ->orderBy('a.nombre')
            ->paginate(200);

            $sum_stock = 0;
            $sum_precio_venta = 0;
            $sum_precio_compra = 0;
            $sum_precio_utilidad = 0;
            foreach ($articulos as $art) {
                $sum_stock += $art->stock;
                $sum_precio_compra += ($art->precio_compra * $art->stock);
                $sum_precio_venta += ($art->precio_venta * $art->stock);
                $sum_precio_utilidad += (($art->precio_venta - $art->precio_compra) * $art->stock);
            }

        return view('reporte.almacen.margen-utilidad.index',["articulos"=>$articulos,"categorias"=>$categorias,"searchText"=>$codigo,"sum_stock"=>$sum_stock,"sum_precio_compra"=>$sum_precio_compra,"sum_precio_venta"=>$sum_precio_venta,"sum_precio_utilidad"=>$sum_precio_utilidad]);
    }
    public function reporte_venta(Request $request)
    {
        $clientes=DB::table('tb_persona')->orderBy('idpersona')->get();
        $vendedor=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

        $muni = $request->get('municipio');
        $vende = $request->get('vendedor');
        $clien = $request->get('cliente');
        $texto = trim($request->get('searchText'));

            $ventas=DB::table('tb_venta as v')
                ->join('tb_persona as p','v.idcliente','=','p.idpersona')
                ->join('tb_persona as p2','v.idvendedor','=','p2.idpersona')
                ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
                ->select('v.idventa','v.idvendedor','v.fecha_hora','p.nombre','p2.nombre as vendedor','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->groupBy('v.idventa','v.fecha_hora','p.nombre','p2.nombre','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->where(function($query) use ($texto,$clien,$vende,$muni,$f1,$f2){
                    if ($clien) {
                        if ($clien != "") {
                             return $query->where('p.idpersona',$clien);
                        }
                    }
                    if ($vende) {
                        if ($vende != "") {
                             return $query->where('v.idvendedor',$vende);
                        }
                    }
                    if ($muni) {
                        if ($muni != "") {
                             return $query->where('p.municipio',$muni);
                        }
                    }
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2]);
                        }
                    }
                })
                ->where('v.estado','Pagada')
                ->orderBy('idventa','desc')
                ->paginate(200);

            $sum_total_venta = 0;
            foreach ($ventas as $venta) {
                $sum_total_venta += $venta->total_venta;

            }
        return view('reporte.venta.index',["ventas"=>$ventas,"clientes"=>$clientes,"vendedor"=>$vendedor,"sum_total_venta"=>$sum_total_venta]);
    }
    public function reporte_venta_cliente(Request $request)
    {
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
                ->select('v.idventa','v.idvendedor','v.fecha_hora','p.nombre','p2.nombre as vendedor','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->groupBy('v.idventa','v.fecha_hora','p.nombre','p2.nombre','p.municipio','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->where(function($query) use ($clien,$muni,$f1,$f2){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($clien != "")) {
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                            ->where(function($q) use ($clien,$muni){
                                                $q->orWhere('p.idpersona',$clien)
                                                ->orWhere('p.municipio',$muni);
                                            });
                        }else{
                             return $query->WhereBetween('v.fecha_hora', [$f1,$f2]);
                        }
                    }
                    if ($clien) {
                        if ($clien != "") {
                             return $query->where('p.idpersona',$clien);
                        }
                    }
                     if ($muni) {
                        if ($muni != "") {
                             return $query->where('p.municipio',$muni);
                        }
                    }
                })
                ->where('v.estado','<>','Anulada')
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
                                            ->where(function($q) use ($vende){
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
        return view('reporte.venta.venta-vendedor.index',["ventas"=>$ventas,"vendedores"=>$vendedores,"sum_total"=>$sum_total,"sum_neto"=>$sum_neto]);
    }

    public function generar()
    {
        //dd($ingresos);
        $view = \View::make('pdf.reporte',compact('tb_articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteArticulo()
    {
        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.estado')
            ->orderBy('categoria')
            ->orderBy('a.nombre')
            ->get();
        $view = \View::make('pdf.reportearticulo',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

     public function ReporteArticuloPrecio()
    {
        $articulos=DB::table('tb_articulo as art')
            ->join('tb_categoria as c','art.idcategoria','=','c.idcategoria')
            ->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
            ->select('art.codigo','art.nombre','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"),'c.nombre as categoria')
            ->where('art.estado','=','Activo')
            ->where('art.stock','>','0')
            ->groupBy('art.codigo','art.nombre','art.stock', 'categoria')
            ->orderBy('categoria')
            ->orderBy('art.nombre')
            ->get();
        $view = \View::make('pdf.reportearticuloprecio',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

     public function ReporteIngreso()
    {
       $ingresos=DB::table('tb_ingreso as i')
        	->join('tb_persona as p','i.idproveedor','=','p.idpersona')
        	->join('tb_detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado')
        	->get();
        	//dd($ingresos);
        $view = \View::make('pdf.reporteingreso',compact('ingresos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteIngresoID($id)
    {
        $ingresos=DB::table('tb_ingreso as i')
        	->join('tb_persona as p','i.idproveedor','=','p.idpersona')
        	->join('tb_detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado')
            ->where('di.idingreso','=',$id)
            ->first();

       $detalles=DB::table('tb_detalle_ingreso as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra')
            ->where('d.idingreso','=',$id)
            ->get();
        $view = \View::make('pdf.reporteingresoid',compact('ingresos','detalles'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReportePersona()
    {
       $personas=DB::table('tb_persona')
            ->get();
        $view = \View::make('pdf.reportepersona',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteCliente()
    {
       $personas=DB::table('tb_persona')
            ->where('tipo_persona','=','Cliente')
            ->get();
        $view = \View::make('pdf.reportecliente',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }
    public function ReporteProveedor()
    {
       $personas=DB::table('tb_persona')
            ->where('tipo_persona','=','Proveedor')
            ->get();
        $view = \View::make('pdf.reporteproveedor',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }
    public function ReporteVendedor()
    {
       $personas=DB::table('tb_persona')
            ->where('tipo_persona','=','Vendedor')
            ->get();
        $view = \View::make('pdf.reportevendedor',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteVenta()
    {
       $ventas=DB::table('tb_venta as v')
        	->join('tb_persona as p','v.idcliente','=','p.idpersona')
        	->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.estado','=','A')
        	->get();
        $view = \View::make('pdf.reporteventa',compact('ventas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteVentaID($id)
    {
       $venta=DB::table('tb_venta as v')
            ->join('tb_persona as p','v.idcliente','=','p.idpersona')
            ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','p.direccion','p.tipo_documento','p.num_documento','p.telefono','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('tb_detalle_venta as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.descuento','d.precio_venta')
            ->where('d.idventa','=',$id)
            ->get();

        $view = \View::make('pdf.reporteventaid',compact('venta','detalles'))->render();
        $paper_size = array(0,0,623.622,433.701); // 'portrait' or 'landscape'

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('landscape');
        return $pdf->stream('informe'.'.pdf');
    }
}
