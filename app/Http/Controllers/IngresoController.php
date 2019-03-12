<?php

namespace PcArts\Http\Controllers;

use Illuminate\Http\Request;
use PcArts\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use PcArts\Ingreso;
use PcArts\DetalleIngreso;
use PcArts\Http\Requests\IngresoFormRequest;
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
            // Variable de busqueda por categoria dond trim quita los espacios en blanco en el inicio y el final
            $query=trim($request->get('searchText'));
            $ingresos=DB::table('tb_ingreso as i')
            	->join('tb_persona as p','i.idproveedor','=','p.idpersona')
            	->join('tb_detalle_ingreso as di','i.idingreso','=','di.idingreso')
            	->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado'
                    ,DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            	->where('i.num_comprobante','LIKE','%'.$query.'%')
            	->orderBy('idingreso','desc')                
                ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado')
                ->paginate(8);                
            return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }
    
    public function create()
    {   
        $personas=DB::table('tb_persona')
            ->where('tipo_persona','=','Proveedor')
            ->get();    	

    	$articulos=DB::table('tb_articulo as art')
    		->select(DB::raw("CONCAT(art.codigo,' - ',art.nombre) AS articulo"),'art.idarticulo')
    		->where('art.estado','=','Activo')
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
                    $detalle->precio_venta=($precio_compra[$cont]+($precio_compra[$cont]*0.30));               	
		        	$detalle->save();	        	
		        	$cont=$cont+1;
		        }
            
    		DB::commit();
    	}catch(\Exception $e){
    		DB::rollback();
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
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }
}
