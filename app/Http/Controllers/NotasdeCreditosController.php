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
use SisVentas\DetalleNotaDebito;
use SisVentas\Http\Requests\NotaDebitoFormRequest;

use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
class NotasdeCreditosController extends Controller
{
   
    public function index(Request $request)
    {
        $code=trim($request->get('searchcodigo'));
            $nodes=DB::table('tb_nota_debito as nd')
                ->join('tb_venta as v','v.idventa','nd.idventa')
                ->join('tb_persona as p','p.idpersona','v.idcliente')                
                ->select('nd.id_node','nd.idventa','nd.tipo_comprobante as tipo','nd.num_comprobante as numero','nd.total_debito','v.estado','nd.fecha','v.idcliente','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante')
                ->where(function($query) use ($code){                   
                    if ($code){
                        if ($code != ""){
                             return $query->where('v.serie_comprobante','LIKE','%'.$code.'%');
                        }
                    }
                })
                ->where('nd.estado','Activo')
                ->orderBy('nd.id_node','desc')
                ->groupBy('nd.id_node','nd.tipo_comprobante','nd.num_comprobante','nd.total_debito','v.estado','nd.fecha','v.idcliente','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante')
                ->get();//paginate(20);
        //dd($nodes);
        return view('ventas.nota-de-credito.index',compact('nodes','code'));
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
            ->select('art.idarticulo','art.nombre','art.stock', 
                DB::raw("MAX(di.precio_venta) AS precio_venta"),
                DB::raw("MAX(di.precio_credito) AS precio_credito"))
            ->where('art.estado','=','Activo')
            ->where('art.stock','>','0')
            ->groupBy('art.idarticulo','art.stock','art.nombre')
            ->orderBy('art.idarticulo')
            ->get();
        return view("ventas.nota-de-credito.create",["personas"=>$personas, "articulos"=>$articulos, "vendedores"=>$vendedores,"ventas"=>$ventas]);
    }

    public function store(NotaDebitoFormRequest $request)
    {
        //dd($request->all());
        try{
            DB::beginTransaction();
                $ND = new NotaDebito;
                $ND->idventa=$request->get('idventa');
                $ND->tipo_comprobante='Nota de Debito';
                $ND->num_comprobante=$request->get('num_comprobante');
                $ND->total_debito=$request->get('total_debito');
                    $mytime = Carbon::now('America/Caracas');
                $ND->fecha=$mytime->toDateTimestring();
                $ND->estado='Activo';
                $ND->save();

                $idarticulo=$request->get('idarticulo');
                $cantidad=$request->get('cantidad');
                $descuento=$request->get('descuento');
                $precio_venta=$request->get('precio_venta');

                $cont = 0;

                while($cont < count($idarticulo))
                { // count($idarticulo)) -> recorre todos los articulos recibidos en el detalle
                    $detalle = new DetalleNotaDebito();
                    $detalle->id_node=$ND->id_node;
                    $detalle->idarticulo=$idarticulo[$cont];
                    $detalle->cantidad=$cantidad[$cont];
                    $detalle->precio_venta=$precio_venta[$cont];
                    $detalle->descuento=$descuento[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }

            DB::commit();
            flash('Nota de Debito Agregada')->success();
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            flash('Error a procesar la Nota de Debito')->warning();
        }
        return Redirect::to('ventas/nota-de-credito');
       // return view("cobranza.cuenta-por-cobrar.index");
        //return Redirect::to('cobranza/cuenta-por-cobrar/index');
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)   {      

            $node=NotaDebito::findOrFail($id);
            $node->estado='Eliminada';         
            $node->save();

        try {
            $detallenode        = new DetalleNotaDebito;
            $detalle_articulos  = $detallenode->Sumadetallenode($id);

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
        return Redirect::to('ventas/nota-de-credito');
    }
}
