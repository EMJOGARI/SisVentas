<?php

namespace PcArts\Http\Controllers;

use Illuminate\Http\Request;

use PcArts\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use PcArts\Persona;
use PcArts\Http\Requests\PersonaFormRequest;
use DB;

class PersonaController extends Controller
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
            // Variable de busqueda por categoria dond trim quita los espacios en blanco en el inicio y el final
            $query=trim($request->get('searchText'));
            $personas=DB::table('persona')           
                ->where('nombre','LIKE','%'.$query.'%')
                ->orwhere('tipo_persona','LIKE','%'.$query.'%')                              
                ->paginate(8);

            return view('seguridad.persona.index',["personas"=>$personas,"searchText"=>$query]);
        }
    }
    
    public function create()
    {
        return view("seguridad.persona.create");
    }
    
    public function store(PersonaFormRequest $request)
    {
        $persona=new Persona;        
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');
        $persona->tipo_persona=$request->get('tipo_persona');        
        $persona->save();
        return Redirect::to('seguridad/persona');      
    }
   
    public function show($id)
    {
        return view("seguridad.persona.show",["persona"=>Persona::findOrFail($id)]);
    }
   
    public function edit($id)
    {
        return view("seguridad.persona.edit",["persona"=>Persona::findOrFail($id)]);
    }
   
    public function update(PersonaFormRequest $request, $id)
    {
        $persona=Persona::findOrFail($id);        
        $persona->nombre=$request->get('nombre');
        $persona->tipo_documento=$request->get('tipo_documento');
        $persona->num_documento=$request->get('num_documento');
        $persona->direccion=$request->get('direccion');
        $persona->telefono=$request->get('telefono');
        $persona->email=$request->get('email');
        $persona->tipo_persona=$request->get('tipo_persona'); 
        $persona->update();
        return Redirect::to('seguridad/persona');
    }
   
    public function destroy($id)
    {
        $persona=Persona::findOrFail($id);
        $persona->tipo_persona='Inactivo';
        $persona->update();
        return Redirect::to('seguridad/persona');
    }
}
