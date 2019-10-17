<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;

use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use SisVentas\Persona;
use SisVentas\Http\Requests\PersonaFormRequest;
use DB;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PersonaController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tipos= DB::table('tb_persona')
            ->select('tipo_persona')
            ->groupBy('tipo_persona')
            ->get();

        $codigo = $request->get('searchCodigo');
        $perso = $request->get('searchPersona');
        $text= Str::upper($request->get('searchText'));//trim($request->get('searchText'));

        $personas=DB::table('tb_persona')
            ->where(function($query) use ($codigo, $text, $perso){
                if ($codigo != "") {
                    return $query->where('idpersona',$codigo);
                }
                if ($perso != "") {
                    return $query->where('tipo_persona',$perso);
                }
                return $query->where('nombre','LIKE','%'.$text.'%');
            })
            ->orderBy('nombre')
            ->paginate(20);

        return view('seguridad.persona.index',["personas"=>$personas,"tipos"=>$tipos,"searchText"=>$text,"searchCodigo"=>$codigo]);
    }
    public function create()
    {
        return view("seguridad.persona.create");
    }

    public function store(PersonaFormRequest $request)
    {
        try{
            $persona=new Persona;
            $persona->nombre=$request->get('nombre');
            $persona->tipo_documento=$request->get('tipo_documento');
            $persona->num_documento=$request->get('num_documento');
            $persona->direccion=$request->get('direccion');
            $persona->telefono=$request->get('telefono');
            $persona->tipo_persona=$request->get('tipo_persona');
            $persona->municipio=$request->get('municipio');
                $mytime = Carbon::now('America/Caracas');
            $persona->fecha_creacion=$mytime->toDateTimestring();
            $persona->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            flash('Persona Duplicada')->error();
        }
        flash('Agregado Exitosamente')->success();
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
        $persona->tipo_persona=$request->get('tipo_persona');
        $persona->municipio=$request->get('municipio');
        $persona->update();
        return Redirect::to('seguridad/persona');
    }

    public function destroy($id)
    {
        $persona=Persona::findOrFail($id);
        $persona->delete();
        return Redirect::to('seguridad/persona');
    }
}
