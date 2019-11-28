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
            $noces=DB::table('tb_nota_credito')->where('estado','Activo')->get();
            $query=trim($request->get('searchText'));
            $ventas=DB::table('tb_venta as v')
            	->join('tb_persona as p','v.idcliente','=','p.idpersona')
            	->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            	->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            	->where('v.serie_comprobante','LIKE','%'.$query.'%')
                ->where('v.estado','<>','Eliminada')
            	->orderBy('idventa','desc')
                ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
                ->paginate(20);

            return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query,"noces"=>$noces]);
        }
    }

    public function create()
    {
        $personas=DB::table('tb_persona')
        	->where('tipo_persona','Cliente')
            ->orwhere('tipo_persona','Proveedor')
            ->orwhere('tipo_persona','Vendedor')
            ->orderBy('idpersona')
            ->get();

        $vendedores=DB::table('tb_persona')
            ->where('tipo_persona','Vendedor')
            ->orderBy('idpersona')
            ->get();

    	$articulos=DB::table('tb_articulo as art')
    		->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
    		->select('art.idarticulo','art.nombre','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"),DB::raw("MAX(di.precio_credito) AS precio_credito"))
    		->where('art.estado','=','Activo')
    		->where('art.stock','>','0')
    		->groupBy('art.idarticulo','art.stock','art.nombre')
            ->orderBy('art.idarticulo')
    		->get();
            //dd($personas, $articulos);
        return view("ventas.venta.create",["personas"=>$personas, "articulos"=>$articulos, "vendedores"=>$vendedores]);
    }
    public function store(VentaFormRequest $request)
    {
       // dd($request->all());
    	try{
    		DB::beginTransaction();
    			$venta = new Venta;
    			$venta->idcliente=$request->get('idcliente');
                $venta->idvendedor=$request->get('idvendedor');
		        $venta->tipo_comprobante='Factura';
		        $venta->serie_comprobante=$request->get('serie_comprobante');
		        $venta->num_comprobante=$request->get('num_comprobante');
				$venta->total_venta=$request->get('total_venta');
                $venta->total_noce=0;
		        	$mytime = Carbon::now('America/Caracas');
		        $venta->fecha_hora=$mytime->toDateTimestring();
		        $venta->estado=$request->get('estado');
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

    		DB::commit();
            flash('Venta Exitosa')->success();
    	}catch(\Exception $e){
    		DB::rollback();
            flash('Error a procesar la venta')->warning();
    	}
        return Redirect::to('ventas/venta');

    }

    public function show($id)
    {
        $vendedor=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idvendedor')
            ->select('p.nombre')
            ->where('v.idventa','=',$id)
            ->first();

        $venta=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_detalle_venta as dv','dv.idventa','v.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('tb_detalle_venta as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.idarticulo','a.nombre as articulo', 'd.cantidad', 'd.descuento','d.precio_venta')
            ->where('d.idventa','=',$id)
            ->get();

        $noces=DB::table('tb_nota_credito')
            ->where('idventa','=',$id)
            ->get();

        $deta_noces=DB::table('tb_detalle_noce as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('d.idnoce','a.idarticulo','a.nombre as articulo', 'd.cantidad','d.precio_venta')
            ->get();
         //dd($nodes, $venta);
        return view("ventas.venta.show",["venta"=>$venta , "detalles"=>$detalles, "vendedor"=>$vendedor, "noces"=>$noces,"deta_noces"=>$deta_noces]);
    }

    public function destroy(Request $request, $id)
    {
        $del = $request->get('delete');
        if ($del == 1) {
            $venta=Venta::findOrFail($id);
            $venta->estado='Eliminada';
            $venta->detalle=$request->get('detalle');
            $venta->save();
        }else{
            $venta=Venta::findOrFail($id);
            $venta->estado='Anulada';
            $venta->detalle=$request->get('detalle');
            $venta->save();
        }

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
