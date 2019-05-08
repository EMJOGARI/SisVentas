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

class VentaController extends Controller
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
            $ventas=DB::table('tb_venta as v')
            	->join('tb_persona as p','v.idcliente','=','p.idpersona')
            	->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            	->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            	->where('v.num_comprobante','LIKE','%'.$query.'%')
                ->where('v.estado','=','A')
            	->orderBy('idventa','desc')
                ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->paginate(10);              
            return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
        }
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
    		->select(DB::raw("CONCAT(art.codigo,' - ',art.nombre) AS articulo"),'art.idarticulo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"))
    		->where('art.estado','=','Activo')
    		->where('art.stock','>','0')
    		->groupBy('articulo','art.idarticulo','art.stock')
            ->orderBy('art.codigo')
    		->get(); 
            //dd($personas, $articulos);
        return view("ventas.venta.create",["personas"=>$personas, "articulos"=>$articulos]);
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
   
    public function show($id)
    {
       $venta=DB::table('tb_venta as v')
            ->join('tb_persona as p','v.idcliente','=','p.idpersona')
            ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('tb_detalle_venta as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.descuento','d.precio_venta')
            ->where('d.idventa','=',$id)            
            ->get();

        return view("ventas.venta.show",["venta"=>$venta , "detalles"=>$detalles]);
    }
   
      
    public function destroy($id)
    {
        $venta=Venta::findOrFail($id);
        $venta->estado='C';
        $venta->save();

        try {
            $detalleventa       = new DetalleVenta;
            $detalle_articulos  = $detalleventa->Sumadetalleventa($id);

            if ($detalle_articulos->count()) {
                DB::beginTransaction();
                    foreach ($detalle_articulos as $key => $detalle) {
                        $articulo = new Articulo;
                        $articulo = $articulo->find($detalle->idarticulo);
                        $articulo->stock += $detalle->suma;
                        $articulo->save();
                     }
                DB::commit();
            }   
        } catch (Exception $e) {
            DB::rollback();
        }

        return Redirect::to('ventas/venta');
    }

    public function restore(){
        try {
            $detalleventa       = new DetalleVenta;
            $detalle_articulos  = $detalleventa->Sumadetalleventa(2);

            if ($detalle_articulos->count()) {
                DB::beginTransaction();
                    foreach ($detalle_articulos as $key => $detalle) {
                        $articulo = new Articulo;
                        $articulo = $articulo->find($detalle->idarticulo);
                        $articulo->stock += $detalle->suma;
                        $articulo->save();
                     }
                DB::commit();
            }   
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
