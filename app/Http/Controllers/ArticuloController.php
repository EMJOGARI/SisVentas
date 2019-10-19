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

        if ($request)
        {
           $codigo = $request->get('searchText');
           // $query=trim($request->get('searchText'));

            $articulos=DB::table('tb_articulo as a')
                ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
                ->select('a.idarticulo','a.nombre','a.stock','c.nombre as categoria','a.estado')
                ->groupBy('a.idarticulo','a.nombre','a.stock','a.estado','c.nombre')
                 ->where(function($query) use ($codigo){                    
                    if ($codigo) {
                        if ($codigo != "") {
                             return $query->where('a.idarticulo',$codigo);
                        }
                    }
                })
                ->where('a.estado','Activo')
                ->orderBy('categoria')
                ->orderBy('a.nombre')
                ->paginate(30);
            return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$codigo]);
        }
    }

    public function create()
    {
        
        $categorias=DB::table('tb_categoria')->where('condicion','=','1')->get();

        return view("almacen.articulo.create",["categorias"=>$categorias]);
    }

    public function store(ArticuloFormRequest $request)
    {
        $articulo=new Articulo;
        $articulo->idcategoria=$request->get('idcategoria');
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
