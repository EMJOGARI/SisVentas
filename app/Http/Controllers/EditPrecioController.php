<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Articulo;
use SisVentas\DetalleIngreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class EditPrecioController extends Controller
{

    public function index(Request $request)
    {//dd($request->all());
        if ($request)
        {
            $codigo = $request->get('searchCodigo');
            $text=trim($request->get('searchText'));
            $articulos=DB::table('tb_articulo as art')
                ->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
                ->select('art.idarticulo','art.nombre','art.codigo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"),DB::raw("MAX(di.precio_compra) AS precio_compra"))
                ->where(function($query) use ($codigo, $text){                    
                        if ($codigo != "") {
                            return $query->where('art.codigo',$codigo);
                        }
                    else{
                        return $query->where('art.nombre','LIKE','%'.$text.'%');
                    }
                    
                })
                ->where('art.estado','=','Activo')
                ->where('art.stock','>=','0')
                ->groupBy('art.idarticulo','art.nombre','art.codigo','art.stock')
                ->orderBy('art.codigo')
                ->paginate(20);
            return view("seguridad.precio_articulo.index",["articulos"=>$articulos,"searchText"=>$text,"searchCodigo"=>$codigo]);
        }
    }

    public function show($id)
    {
         return view("seguridad.precio_articulo.show",["articulo"=>Articulo::findOrFail($id)]);
    }

    public function edit($id)
    {
       $articulos=DB::table('tb_articulo as art')
            ->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
            ->select('art.idarticulo','art.nombre','art.codigo','art.stock',DB::raw("MAX(di.precio_compra) AS precio_compra"), DB::raw("MAX(di.precio_venta / 0.70) AS precio_venta"),DB::raw("MAX(di.precio_venta) AS precio_venta_actual"))
            ->groupBy('art.idarticulo','art.nombre','art.codigo','art.stock')
            ->where('art.idarticulo',$id)
            ->first();

            return view("seguridad.precio_articulo.edit",["articulos"=>$articulos]);
    }

    public function update(Request $request, $id)
    {
        $pv = $request->get('up_precio_venta');
        if ($pv == 1) {
             DB::table('tb_detalle_ingreso as di')
                ->join('tb_articulo as art','art.idarticulo','=','di.idarticulo')
                ->select('art.idarticulo','art.nombre','art.codigo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta")) //probando esta linea
                ->where('art.idarticulo',$id)
                ->update(array('precio_venta' => Input::get('precio_venta')));
        } else {
        DB::table('tb_detalle_ingreso as di')
            ->join('tb_articulo as art','art.idarticulo','=','di.idarticulo')
            ->select('art.idarticulo','art.nombre','art.codigo','art.stock', DB::raw("MAX(di.precio_compra) AS precio_compra")) //probando esta linea
            ->where('art.idarticulo',$id)
            ->update(array('precio_compra' => Input::get('precio_compra')));
        }

        DB::table('tb_articulo')
            ->where('idarticulo',$id)
            ->update(array('stock' => Input::get('stock')));

        return Redirect::to('seguridad/precio_articulo');
    }
}
