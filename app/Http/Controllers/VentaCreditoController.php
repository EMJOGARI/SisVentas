<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Venta;
use SisVentas\DetalleVenta;
use SisVentas\Articulo;
use SisVentas\Http\Requests\VentaFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaCreditoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    
    public function create()
    {   
        $personas=DB::table('tb_persona')
        	->where('tipo_persona','Cliente')
            ->orwhere('tipo_persona','Proveedor')
            ->orwhere('tipo_persona','Vendedor')
            ->get();    	

    	$articulos=DB::table('tb_articulo as art')
    		->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
    		->select(DB::raw("CONCAT(art.codigo,' - ',art.nombre) AS articulo"),'art.idarticulo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"),DB::raw("MAX(di.precio_credito) AS precio_credito"))
    		->where('art.estado','=','Activo')
    		->where('art.stock','>','0')
    		->groupBy('articulo','art.idarticulo','art.stock')
            ->orderBy('art.codigo')
    		->get(); 
            //dd($personas, $articulos);
        return view("ventas.venta.credito.create",["personas"=>$personas, "articulos"=>$articulos]);
    }    
    public function store(VentaFormRequest $request)
    {       
    	try{
    		DB::beginTransaction();
    			$venta = new Venta;
    			$venta->idcliente=$request->get('idcliente');
		        $venta->tipo_comprobante=$request->get('tipo_comprobante');
		        $venta->serie_comprobante=$request->get('serie_comprobante');
		        $venta->num_comprobante=$request->get('num_comprobante');
				$venta->total_venta=$request->get('total_venta');
		        	$mytime = Carbon::now('America/Caracas');
		        $venta->fecha_hora=$mytime->toDateTimestring();
		        $venta->estado='A';
		        $venta->save();

		        $idarticulo=$request->get('idarticulo');
		        $cantidad=$request->get('cantidad');
		        $descuento=$request->get('descuento');
		        $precio_venta=$request->get('precio_venta');		       

		        $cont = 0;

		        while($cont < count($idarticulo))
                { // count($idarticulo)) -> recorre todos los articulos recibidos en el detalle                   
		        	$detalle = new DetalleVenta();
		        	$detalle->idventa=$venta->idventa;
		        	$detalle->idarticulo=$idarticulo[$cont];
		        	$detalle->cantidad=$cantidad[$cont];
                    $detalle->precio_venta=$precio_venta[$cont];
		        	$detalle->descuento=$descuento[$cont];		        			        	
		        	$detalle->save();
		        	$cont=$cont+1;
		        }
                flash('Venta Exitosa')->success();
    		DB::commit();
    	}catch(\Exception $e){
    		DB::rollback();
            flash('Error a procesar la venta')->warning();
    	}
        
        return Redirect::to('ventas/venta');   

    }  
}
