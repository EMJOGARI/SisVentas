<?php

namespace PcArts\Http\Controllers;

use Illuminate\Http\Request;
use PcArts\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use PcArts\Articulo;
use PcArts\Http\Requests\ArticuloFormRequest;
use DB;

class ArticuloController extends Controller
{
   public function __construct()
    {

    }
    
    public function index(Request $request)
    {
        //dd($request->all());
        if ($request)
        {           
            $query=trim($request->get('searchText'));
            $articulos=DB::table('articulo as a')
                ->join('categoria as c','a.idcategoria','=','c.idcategoria')
                ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.costo','c.nombre as categoria','a.descripcion','a.estado')
                ->where('a.nombre','LIKE','%'.$query.'%') 
                ->orwhere('a.codigo','LIKE','%'.$query.'%')            
                ->orderBy('a.idarticulo','desc')
                ->paginate(8);
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
        }

    }
    
    public function create()
    {
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }
    
    public function store(ArticuloFormRequest $request)
    {
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');               
        $articulo->descripcion=$request->get('descripcion');
        $articulo->costo='0';
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
        $categorias=DB::table('categoria')->where('condicion','=','1')->get();
        return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
    }
   
    public function update(ArticuloFormRequest $request, $id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->idcategoria=$request->get('idcategoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->nombre=$request->get('nombre');
        $articulo->stock='0';
        $articulo->costo='0';
        $articulo->descripcion=$request->get('descripcion');
        $articulo->estado='Activo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
   
    public function destroy($id)
    {
        $articulo=Articulo::findOrFail($id);
        $articulo->estado='Inactivo';
        $articulo->update();
        return Redirect::to('almacen/articulo');
    }
}
