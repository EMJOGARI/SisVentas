<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use SisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use SisVentas\Venta;
use SisVentas\DetalleVenta;
use SisVentas\Articulo;
use SisVentas\NotaCredito;
use SisVentas\DetalleNotaCredito;
use SisVentas\Http\Requests\NotaCreditoFormRequest;

use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
class NotasdeCreditosController extends Controller
{

    public function index(Request $request)
    {
        $code=trim($request->get('searchcodigo'));
            $noces=DB::table('tb_nota_credito as nd')
                ->join('tb_venta as v','v.idventa','nd.idventa')
                ->join('tb_persona as p','p.idpersona','v.idcliente')
                ->select('nd.idnoce','nd.idventa','nd.tipo','nd.num_noce as numero','nd.total_noce','v.estado','nd.fecha','v.idcliente','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante')
                ->where(function($query) use ($code){
                    if ($code){
                        if ($code != ""){
                             return $query->where('nd.num_noce','LIKE','%'.$code.'%');
                        }
                    }
                })
                ->where('nd.estado','Activo')
                ->orderBy('nd.idnoce','desc')
                ->groupBy('nd.idnoce','nd.tipo','nd.num_noce','nd.total_noce','v.estado','nd.fecha','v.idcliente','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante')
                ->get();//paginate(20);
        //dd($nodes);
        return view('ventas.nota-de-credito.index',compact('noces','code'));
    }
/*
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

    public function store(NotaDebitoFormRequest $request)//NotaDebitoFormRequest
    {
       try{
            DB::beginTransaction();

                $NC = new NotaDebito;
                $NC->idventa=$request->get('idventa');
                $NC->tipo_comprobante='NC';
                $NC->num_comprobante=$request->get('num_comprobante');
                $NC->total_debito=$request->get('total_debito');
                    $mytime = Carbon::now('America/Caracas');
                $NC->fecha=$mytime->toDateTimestring();
                $NC->estado='Activo';
                $NC->save();

                $idarticulo=$request->get('idarticulo');
                $cantidad=$request->get('cantidad');
                $descuento=$request->get('descuento');
                $precio_venta=$request->get('precio_venta');

                $cont = 0;

                while($cont < count($idarticulo))
                {
                    $detalle = new DetalleNotaDebito();
                    $detalle->id_node=$NC->id_node;
                    $detalle->idarticulo=$idarticulo[$cont];
                    $detalle->cantidad=$cantidad[$cont];
                    $detalle->precio_venta=$precio_venta[$cont];
                    $detalle->descuento=$descuento[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }

                $venta=Venta::findOrFail($request->get('idventa'));
                $venta->idnoce=$NC->id_node;
                $venta->total_noce=$request->get('total_debito');
                $venta->update();

            DB::commit();
            flash('Nota de Debito Agregada')->success();
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            flash('Error a procesar la Nota de Debito')->warning();
        }

        return Redirect::to('ventas/nota-de-credito');
    }

    public function show($id)
    {
        $ventas=Venta::findOrFail($id);
        $detalles=DetalleNotaDebito::findOrFail($id);

        return view("ventas.nota-de-credito.show",compact('ventas','detalles'));
    }
*/
    public function edit($id)
    {
        $vendedor=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idvendedor')
            ->select('p.nombre')
            ->where('v.idventa','=',$id)
            ->first();

        $ventas=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_detalle_venta as dv','dv.idventa','v.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('tb_detalle_venta as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.idarticulo','a.nombre', 'd.cantidad as stock', 'd.descuento','d.precio_venta')
            ->where('d.idventa','=',$id)
            ->get();

        return view("ventas.nota-de-credito.edit",compact('ventas','detalles','vendedor'));
    }

    public function update(NotaCreditoFormRequest $request, $id)
    {   //dd($request->all());        
        try{
            DB::beginTransaction();
                $NC = new NotaCredito;
                $NC->idventa=$request->get('idventa');
                $NC->tipo='NC';
                $NC->num_noce=$request->get('num_noce');
                $NC->serie_noce=$request->get('serie_noce');
                $NC->total_noce=$request->get('total_credito');
                    $mytime = Carbon::now('America/Caracas');
                $NC->fecha=$mytime->toDateTimestring();
                $NC->estado='Activo';
                $NC->save();

                $idarticulo=$request->get('idarticulo');
                $cantidad=$request->get('cantidad');
                $descuento=$request->get('descuento');
                $precio_venta=$request->get('precio_venta');

                $cont = 0;

                while($cont < count($idarticulo))
                {
                    $detalle = new DetalleNotaCredito();
                    $detalle->idnoce=$NC->idnoce;
                    $detalle->idarticulo=$idarticulo[$cont];
                    $detalle->cantidad=$cantidad[$cont];
                    $detalle->precio_venta=$precio_venta[$cont];
                    //$detalle->descuento=$descuento[$cont];
                    $detalle->save();
                    $cont=$cont+1;
                }

                $venta=Venta::findOrFail($id);
                $venta->idnoce=$NC->idnoce;
                $venta->total_noce=$request->get('total_credito');
                $venta->update();

            DB::commit();
            flash('Nota de Credito Agregada')->success();
        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            flash('Error a procesar la Nota de Credito')->warning();
        }
        return Redirect::to('ventas/nota-de-credito');       
    }

    public function destroy($id)   {

        $node=NotaCredito::findOrFail($id);
        $node->estado='Eliminada';
        $node->save();

        try {
            $detallenoce        = new DetalleNotaCredito;
            $detalle_articulos  = $detallenoce->Sumadetallenoce($id);

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
            dd($e);
            DB::rollback();
        }

        $sell=DB::table('tb_venta')
            ->where('idnoce',$id)
            ->first();

        $venta=Venta::findOrFail($sell->idventa);   
        $venta->idnoce=0;
        $venta->total_noce=0;
        $venta->save();
        
        $detalle=DB::table('tb_detalle_noce')
            ->where('idnoce',$id)
            ->delete();

        $delete=NotaCredito::findOrFail($id);
        $delete->delete();

        flash('Nota de Credito Eliminada')->success();

        return Redirect::to('ventas/nota-de-credito');
    }
}
