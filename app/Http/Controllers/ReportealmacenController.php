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

    public function resumen_almacen(Request $request){
        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','c.idcategoria','a.idcategoria')
            ->select('c.idcategoria','c.nombre',DB::raw("SUM(a.stock) AS stock"))
            ->where('a.estado','Activo')
            ->where('a.stock','>','0')
            ->groupBy('c.idcategoria','c.nombre')
            ->orderBy('c.idcategoria')
            ->get();
            $sum_stock = 0;
            foreach ($articulos as $art) {
                $sum_stock += $art->stock;
            }

        return view('reporte.almacen.resumen-inventario.index',["articulos"=>$articulos,"sum_stock"=>$sum_stock]);
    }
}
