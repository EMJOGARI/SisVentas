<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Articulo;
use SisVentas\Http\Requests\ArticuloFormRequest;
use DB;

class ArticuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        //dd($request->all());
        if ($request)
        {           
            $query=trim($request->get('searchText'));
            $articulos=DB::table('tb_articulo as a')
                ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
                ->join('tb_detalle_ingreso as di','a.idarticulo','=','di.idarticulo')
                ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.estado', DB::raw("MAX(di.precio_venta) AS precio_venta"), DB::raw("MAX(di.precio_compra) AS precio_compra"))
                ->where('a.codigo','LIKE','%'.$query.'%') //('a.nombre','LIKE','%'.$query.'%') 
                ->orwhere('a.nombre','LIKE','%'.$query.'%')
                ->groupBy('a.idarticulo','a.nombre','a.codigo','a.stock','a.estado','c.nombre')
                ->where('a.estado','Activo')            
                ->orderBy('categoria')
                ->orderBy('a.nombre')
                ->paginate(20);
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }
    }
    
    public function create()
    {
        $articulos=DB::table('tb_articulo as a')
            ->select('codigo',DB::raw("MAX(idarticulo) AS id"))
            ->groupBy('codigo')
            ->get();

        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();

        return view("almacen.articulo.create",["categorias"=>$categorias,"articulos"=>$articulos]);
    }
    
    public function store(ArticuloFormRequest $request)
    {
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock='0';
        $articulo->estado='Activo';
        $articulo->save();
        return Redirect::to('almacen/articulo');      
    }
   
    public function show($id)
    {
        return view("almacen.articulo.show",["articulo"=>Categoria::findOrFail($id)]);
    }
   
    public function edit($id)
    {
        $articulo=Articulo::findOrFail($id);
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
   
    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        //$articulo->stock='0'; 
        $articulo->estado='Activo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
   
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->stock='0';
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}
