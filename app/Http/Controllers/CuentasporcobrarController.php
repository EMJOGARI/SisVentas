<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Venta;
use SisVentas\DetalleVenta;
use SisVentas\Articulo;
use SisVentas\NotaDebito;
use SisVentas\Http\Requests\NotaDebitoFormRequest;

use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class CuentasporcobrarController extends Controller
{
    public function index(Request $request)
    {
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
        $vende = $request->get('searchVendedor');
 
        $fact=trim($request->get('searchText'));
        $ventas=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_persona as p2','p2.idpersona','v.idvendedor')
            ->join('tb_detalle_venta as dv','v.idventa','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','p2.nombre as vendedor','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where(function($query) use ($fact,$vende){
                if($fact){
                    if ($fact != "") {
                        return $query->where('v.serie_comprobante',$fact);
                    }
                }
                if ($vende) {
                    if ($vende != "") {
                         return $query->where('v.idvendedor',$vende);
                    }
                }
            })
            ->where('v.estado','Pendiente')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','p2.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->orderBy('idventa','desc')
            ->paginate(20);
        return view('cobranza.cuenta-por-cobrar.index',["ventas"=>$ventas,"searchText"=>$fact,"vendedores"=>$vendedores]);
    }


    public function create()
    {
        $ventas=DB::table('tb_venta as v')
            ->where('estado','Pendiente')
            ->orderBy('idventa','desc')
            ->get();

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
            ->select(DB::raw("CONCAT(art.codigo,' - ',art.nombre) AS articulo"),'art.idarticulo','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"),DB::raw("MAX(di.precio_credito) AS precio_credito"))
            ->where('art.estado','=','Activo')
            ->where('art.stock','>','0')
            ->groupBy('articulo','art.idarticulo','art.stock')
            ->orderBy('art.codigo')
            ->get();
            //dd($ventas);
        return view("cobranza.cuenta-por-cobrar.create",["personas"=>$personas, "articulos"=>$articulos, "vendedores"=>$vendedores,"ventas"=>$ventas]);        
    }

    public function store(NotaDebitoFormRequest $request)
    {
       // dd($request->all());
        try{
            DB::beginTransaction();
                $ND = new NotaDebito;
                $ND->idventa=$request->get('idventa');
                $ND->tipo_comprobante='Nota de Debito';
                $ND->num_comprobante=$request->get('num_comprobante');
                $ND->total_debito=0;//$request->get('total_venta');
                    $mytime = Carbon::now('America/Caracas');
                $ND->fecha=$mytime->toDateTimestring();
                $ND->estado=$request->get('estado');
                $ND->save();
             /*
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
                }*/

            DB::commit();
            flash('Nota de Debito Agregada')->success();
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            flash('Error a procesar la venta')->warning();
        }
        return Redirect::to('ventas/venta');
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
         $up = $request->get('up_stado');
        if ($up == 1) {
            $venta=Venta::findOrFail($id);
            $venta->estado=$request->get('estado');
            $venta->save();
        }
        return Redirect::to('cobranza/cuenta-por-cobrar');
    }
} /* FIN CuentasporcobrarController */
