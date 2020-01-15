<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\VariableVendedor;
use SisVentas\Http\Requests\ArticuloFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VariablevendedorController extends Controller
{
    public function index(Request $request)
    {
        $variable=DB::table('tb_variable_vendedor')
            ->whereMonth('fecha', date('m'))
            ->orderBy('idvendedor')
            ->get();
        return view('seguridad.variable_vendedor.index',compact('variable'));
    }

    public function create()
    {
        $vendedores=DB::table('tb_persona')
            ->where([
                    ['tipo_persona','Vendedor'],
                    ['estado','1']
                ])
            ->orderBy('idpersona')
            ->get();


        return view("seguridad.variable_vendedor.create",compact('vendedores'));
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
                $var=new VariableVendedor;
                $var->idvendedor=$request->get('idvendedor');
                $var->cuota_venta=$request->get('cuota_venta');
                $var->incentivo_venta=$request->get('incentivo_venta');
                $var->cuota_cliente_activar=$request->get('cuota_cliente_activar');
                $var->incentivo_cliente_activar=$request->get('incentivo_cliente_activar');
                    $mytime = Carbon::now('America/Caracas');
                $var->fecha=$mytime->toDateTimestring();
                $var->save();
            DB::commit();
            flash('Variales del vendedor agregado con Exitoso')->success();
        }catch(\Exception $e){
            DB::rollback();
            flash('Error a procesar la carga de datos')->warning();
        }
        return Redirect::to('seguridad/variable_vendedor');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
