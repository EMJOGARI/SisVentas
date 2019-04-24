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
            $query=trim($request->get('searchText'));
            $articulos=DB::table('tb_articulo as art')
                ->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
                ->select('art.idarticulo','art.nombre','art.codigo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"))
                ->where('art.estado','=','Activo')
                ->where('art.stock','>','0')
                ->where('art.nombre','LIKE','%'.$query.'%') 
                ->orwhere('art.codigo','LIKE','%'.$query.'%')  
                ->groupBy('art.idarticulo','art.nombre','art.codigo','art.stock')
                ->orderBy('art.codigo')
                ->paginate(10);
            return view("seguridad.precio_articulo.index",["articulos"=>$articulos,"searchText"=>$query]);
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
            ->select('art.idarticulo','art.nombre','art.codigo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta")) 
            ->groupBy('art.idarticulo','art.nombre','art.codigo','art.stock')
            ->where('art.idarticulo',$id)
            ->first();
            return view("seguridad.precio_articulo.edit",["articulos"=>$articulos]);
    }

    public function update(Request $request, $id)
    {
        DB::table('tb_detalle_ingreso as di')
            ->join('tb_articulo as art','art.idarticulo','=','di.idarticulo')
            ->select('art.idarticulo','art.nombre','art.codigo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta")) //probando esta linea
            ->where('art.idarticulo',$id)
            ->update(array('precio_venta' => Input::get('precio_venta')));
        
        DB::table('tb_articulo')
            ->where('idarticulo',$id)
            ->update(array('stock' => Input::get('stock')));

        return Redirect::to('seguridad/precio_articulo');
    }
}
