<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Ingreso;
use SisVentas\DetalleIngreso;
use SisVentas\Articulo;
use SisVentas\Http\Requests\IngresoFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
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
            $ingresos=DB::table('tb_ingreso as i')
            	->join('tb_persona as p','i.idproveedor','=','p.idpersona')
            	->join('tb_detalle_ingreso as di','i.idingreso','=','di.idingreso')
            	->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado'
                    ,DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            	->where('i.num_comprobante','LIKE','%'.$query.'%')
                ->where('i.estado','=','A')
            	->orderBy('idingreso','desc')
                ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado')
                ->paginate(50);
            return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }

    public function create()
    {
        $personas=DB::table('tb_persona')
            ->where('tipo_persona','Proveedor')
            ->orwhere('tipo_persona','Cliente')
            ->orderBy('idpersona')
            ->get();

    	$articulos=DB::table('tb_articulo as art')
    		->select(DB::raw("CONCAT(art.codigo,' - ',art.nombre) AS articulo"),'art.idarticulo')
    		->where('art.estado','=','Activo')
            ->orderBy('art.codigo')
    		->get();
        return view("compras.ingreso.create",["personas"=>$personas, "articulos"=>$articulos]);
    }

    public function store(IngresoFormRequest $request)
    {
    	try{
    		DB::beginTransaction();
    			$ingreso = new Ingreso;
    			$ingreso->idproveedor=$request->get('idproveedor');
		        $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
		        $ingreso->serie_comprobante=$request->get('serie_comprobante');
		        $ingreso->num_comprobante=$request->get('num_comprobante');
                $ingreso->total_compra=$request->get('total_compra');
		          $mytime = Carbon::now('America/Caracas');
		        $ingreso->fecha_hora=$mytime->toDateTimestring();
		        $ingreso->estado='A';
		        $ingreso->save();

		        $idarticulo=$request->get('idarticulo');
		        $cantidad=$request->get('cantidad');
		        $precio_compra=$request->get('precio_compra');

		        $cont = 0;

		        while($cont < count($idarticulo)){
		        	$detalle = new DetalleIngreso();
		        	$detalle->idingreso=$ingreso->idingreso;
		        	$detalle->idarticulo=$idarticulo[$cont];
		        	$detalle->cantidad=$cantidad[$cont];
		        	$detalle->precio_compra=$precio_compra[$cont];
                    $detalle->precio_venta=($precio_compra[$cont]/0.70);
		        	$detalle->save();
		        	$cont=$cont+1;
		        }
            flash('Ingreso Exitoso')->success();
    		DB::commit();

    	}catch(\Exception $e){
    		DB::rollback();
            flash('Error a procesar el ingreso de la factura')->warning();
    	}

        return Redirect::to('compras/ingreso');
    }

    public function show($id)
    {
       $ingreso=DB::table('tb_ingreso as i')
            ->join('tb_persona as p','i.idproveedor','=','p.idpersona')
            ->join('tb_detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado')
            ->where('i.idingreso','=',$id)
            ->first();

        $detalles=DB::table('tb_detalle_ingreso as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra')
            ->where('d.idingreso','=',$id)
            ->get();

        return view("compras.ingreso.show",["ingreso"=>$ingreso , "detalles"=>$detalles]);
    }

    public function destroy($id)
    {
        $ingreso=Ingreso::findOrFail($id);
        $ingreso->estado='C';
        $ingreso->save();

        try {
            $detalleingreso       = new DetalleIngreso;
            $detalle_articulos  = $detalleingreso->Sumadetalleingreso($id);

            if ($detalle_articulos->count()) {
                DB::beginTransaction();
                    foreach ($detalle_articulos as $key => $detalle) {
                        $articulo = new Articulo;
                        $articulo = $articulo->find($detalle->idarticulo);
                        $articulo->stock -= $detalle->suma;
                        $articulo->save();
                     }
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollback();
        }

        return Redirect::to('compras/ingreso');
    }

    public function restore(){
        try {
            $detalleingreso       = new DetalleIngreso;
            $detalle_articulos  = $detalleingreso->Sumadetalleingreso(2);

            if ($detalle_articulos->count()) {
                DB::beginTransaction();
                    foreach ($detalle_articulos as $key => $detalle) {
                        $articulo = new Articulo;
                        $articulo = $articulo->find($detalle->idarticulo);
                        $articulo->stock -= $detalle->suma;
                        $articulo->save();
                     }
                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
