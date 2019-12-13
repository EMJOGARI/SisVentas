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

class ReportealmacenController extends Controller
{
    /**************************/
    /** REPORTES DEL ALMACEN **/
    /**************************/
    public function reporte_almacen(Request $request)
    {
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();

        $codigo =$request->get('searchText');
        $stock = trim($request->get('searchList'));
        $cat = trim($request->get('searchCategoria'));

        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
            ->join('tb_detalle_ingreso as di','a.idarticulo','=','di.idarticulo')
            ->select('a.idarticulo','a.nombre','a.stock','c.nombre as categoria','a.estado',
                DB::raw("MAX(di.precio_venta) AS precio_venta"),
                DB::raw("MAX(di.precio_compra) AS precio_compra")
            )
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
            ->groupBy('a.idarticulo','a.nombre','a.stock','a.estado','c.nombre')
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
            ->select('a.idarticulo','a.nombre','a.stock','c.nombre as categoria','a.estado',
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
            ->groupBy('a.idarticulo','a.nombre','a.stock','a.estado','c.nombre')
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

    public function resumen_almacen(Request $request)
    {
        $neto=DB::table('tb_articulo as a')
            ->join('tb_detalle_ingreso as di','di.idarticulo','a.idarticulo')
            ->select('a.idcategoria',
                DB::raw("MAX(precio_venta * a.stock) AS precio")
            )
            ->where([
                    ['a.estado','Activo'],
                    ['a.stock','>','0']
                ])
            ->groupBy('a.idcategoria','a.stock','a.idarticulo')
            ->orderBy('a.idcategoria')
            ->get();

            $sum_cat_2 = 0; $sum_cat_3 = 0; $sum_cat_4 = 0; $sum_cat_5 = 0; $sum_cat_6 = 0;
            $sum_cat_7 = 0; $sum_cat_8 = 0; $sum_cat_10 = 0; $sum_cat_10 = 0; $sum_cat_11 = 0;
            foreach ($neto as $net) {
                switch ($net->idcategoria) {
                    case 2:
                        $sum_cat_2 += $net->precio;
                        break;
                    case 3:
                        $sum_cat_3 += $net->precio;
                        break;
                    case 4:
                        $sum_cat_4 += $net->precio;
                        break;
                    case 5:
                        $sum_cat_5 += $net->precio;
                        break;
                    case 6:
                        $sum_cat_6 += $net->precio;
                        break;
                    case 7:
                        $sum_cat_7 += $net->precio;
                        break;
                    case 8:
                        $sum_cat_8 += $net->precio;
                        break;
                    case 10:
                        $sum_cat_10 += $net->precio;
                        break;
                    case 11:
                        $sum_cat_11 += $net->precio;
                        break;
                }
            }
            $total_catgoria = $sum_cat_2 + $sum_cat_3 + $sum_cat_4 + $sum_cat_5 + $sum_cat_6 + $sum_cat_7 + $sum_cat_8 + $sum_cat_10 + $sum_cat_11;

        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','c.idcategoria','a.idcategoria')
            ->select('c.idcategoria','c.nombre',DB::raw("SUM(a.stock) AS stock"))
            ->where([
                    ['a.estado','Activo'],
                    ['a.stock','>','0']
                ])
            ->groupBy('c.idcategoria','c.nombre')
            ->orderBy('c.idcategoria')
            ->get();
            $sum_stock = 0;
            foreach ($articulos as $art) {
                $sum_stock += $art->stock;
            }

        return view('reporte.almacen.resumen-inventario.index',compact('articulos','sum_stock','sum_cat_2','sum_cat_3','sum_cat_4','sum_cat_5','sum_cat_6','sum_cat_7','sum_cat_8','sum_cat_10','sum_cat_11','total_catgoria'));
    }
    public function articulo_menos_vendido(Request $request)
    {
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();
        $cat = trim($request->get('searchCategoria'));

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

        $date = Carbon::now();

        if(($f1 != "") & ($f2 != "")){
            $date_1 = $request->get('FechaInicio');
            $date_2 = $request->get('FechaFinal');
        }else{
            $date_1 = $date->format('Y-m-01');
            $date_2 = $date;//$date->format('Y-m-d');
        }

        $art_venta=DB::table('tb_detalle_venta as dv')
            ->join('tb_venta as v','v.idventa','dv.idventa')
            ->join('tb_articulo as a','a.idarticulo','dv.idarticulo')
            ->select('dv.idarticulo')
            ->where([
                    ['v.fecha_hora','>=',$date_1],
                    ['v.fecha_hora','<=',$date_2],
                    ['v.estado','<>','Anulada'],
                    ['v.estado','<>','Eliminada']
                ])
            ->groupBy('dv.idarticulo')
            ->orderBy('dv.idarticulo')
            ->get();

        $data = [];
        foreach($art_venta as $ven){
            $data[] = $ven->idarticulo;
        }

        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','c.idcategoria','a.idcategoria')
            ->select('a.idarticulo','a.nombre','c.nombre as categoria','a.stock')
            ->where(function($query) use ($cat){
                if($cat){
                    if ($cat != "") {
                        return $query->where('c.idcategoria',$cat);
                    }
                }
            })
            ->where([
                ['a.stock','>','0'],
                ['a.estado','Activo']
            ])
            ->whereNotIn('a.idarticulo',$data)
            ->orderBy('a.idarticulo')
            ->paginate(50);
        //dd($articulos);
        return view('reporte.almacen.producto-menos-vendido.index',compact('articulos','categorias'));
    }
    public function articulo_mas_vendido(Request $request)
    {
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();
        $cat = trim($request->get('searchCategoria'));

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

        $date = Carbon::now();

        if(($f1 != "") & ($f2 != "")){
            $date_1 = $request->get('FechaInicio');
            $date_2 = $request->get('FechaFinal');
        }else{
            $date_1 = $date->format('Y-m-01');
            $date_2 = $date;//$date->format('Y-m-d');
        }

        $art_ventas=DB::table('tb_detalle_venta as dv')
            ->join('tb_venta as v','v.idventa','dv.idventa')
            ->join('tb_articulo as a','a.idarticulo','dv.idarticulo')
            ->join('tb_categoria as c','c.idcategoria','a.idcategoria')
            ->select('dv.idarticulo','a.nombre','c.nombre as categoria',DB::raw("sum(cantidad) as cantidad"))
            ->where(function($query) use ($cat){
                if($cat){
                    if ($cat != "") {
                        return $query->where('c.idcategoria',$cat);
                    }
                }
            })
            ->where([
                    ['v.fecha_hora','>=',$date_1],
                    ['v.fecha_hora','<=',$date_2],
                    ['v.estado','<>','Anulada'],
                    ['v.estado','<>','Eliminada']
                ])
            ->groupBy('dv.idarticulo','a.nombre','c.nombre')
            ->orderBy('cantidad','desc')
            ->paginate(50);
            //sdd($art_venta);
        return view('reporte.almacen.producto-mas-vendido.index',compact('art_ventas','categorias'));
    }
}
