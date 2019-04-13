<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;

use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisVentas\User;
use SisVentas\Rol;
use SisVentas\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request)
        {           
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('tb_users as u')
                ->join('tb_roles as r','u.idrol','=','r.idrol')
                ->select('u.id','u.name','u.email','r.description')
                ->where('u.name','LIKE','%'.$query.'%')                         
                ->orderBy('id')
                ->paginate(8);
            return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

     public function create()
    {
        $usuarios=DB::table('tb_users as u')
                ->join('tb_roles as r','u.idrol','=','r.idrol')
                ->select('u.id','u.name','u.email','r.description as tipo','r.idrol')
                ->get();
        return view("seguridad.usuario.create",["usuarios"=>$usuarios]);
    }

    public function store(UsuarioFormRequest $request)
    {
       
        $usuario=new User;
        $usuario->idrol=$request->get('idrol');
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->save();        
        return Redirect::to('seguridad/usuario');      
    }

    public function show($id)
    {
        return view("seguridad.usuario.show",["usuario"=>User::findOrFail($id)]);
    }
   
    public function edit($id)
    {
        $usuario=User::findOrFail($id);
        $rol=DB::table('tb_roles')->where('idrol','>','1')->get();
        return view("seguridad.usuario.edit",["usuario"=>$usuario,"rol"=>$rol]);
    }
    public function update(UsuarioFormRequest $request, $id)
    {
        $categoria=User::findOrFail($id);
        $usuario->idrol=$request->get('idrol');
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password')); 
        $categoria->update();
        return Redirect::to('seguridad/usuario');
    }
   
    public function destroy($id)
    {
        $categoria= DB::table('tb_users')
        	->where('id','=',$id)
        	->delete();       
        return Redirect::to('seguridad/usuario');
    }
}
