<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Variable;
use SisVentas\Http\Requests\ArticuloFormRequest;
use DB;

class VariableController extends Controller
{
    /**
        'comision_max',
        'comision_min',
        'meta_cumplir',
        'dia_min',
        'dia_max'
     */
    public function index()
    {
        $variables=DB::table('tb_variable')
            ->get();
        return view('seguridad.variable_comision.index',compact('variables'));
    }

    public function create()
    {
        return view("seguridad.variable_comision.create");
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
                $var=new Variable;
                $var->meta_cumplir=$request->get('meta_cumplir');
                $var->objetivo_meta=$request->get('objetivo_meta');
                $var->visita_activa=$request->get('visita_activa');
                $var->objetivo_visita=$request->get('objetivo_visita');
                $var->comision_max=$request->get('comision_max');
                $var->comision_min=$request->get('comision_min');
                $var->dia_min=$request->get('dia_min');
                $var->dia_max=$request->get('dia_max');
                $var->save();
            DB::commit();
            flash('Variables Agregadas Exitosamente')->success();
        }catch(\Exception $e){
            DB::rollback();
            flash('Error a procesar la carga de datos')->warning();
        }

        return Redirect::to('seguridad/variable_comision');
    }


    public function edit($id)
    {
        $variables=Variable::first();
        return view('seguridad.variable_comision.edit',compact('variables'));
    }

    public function update(Request $request, $id)
    { try{
            DB::beginTransaction();
                $variables=Variable::first();
                $variables->meta_cumplir=$request->get('meta_cumplir');
                $variables->objetivo_meta=$request->get('objetivo_meta');
                $variables->visita_activa=$request->get('visita_activa');
                $variables->objetivo_visita=$request->get('objetivo_visita');
                $variables->comision_max=$request->get('comision_max');
                $variables->comision_min=$request->get('comision_min');
                $variables->dia_min=$request->get('dia_min');
                $variables->dia_max=$request->get('dia_max');
                $variables->save();
            DB::commit();
            flash('Variable Actualizada Exitosamente')->success();
        }catch(\Exception $e){
            DB::rollback();
            flash('Error a procesar la carga de datos')->warning();
        }
        return Redirect::to('seguridad/variable_comision');
    }

}
