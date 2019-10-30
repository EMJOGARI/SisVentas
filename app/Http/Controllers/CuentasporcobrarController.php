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

class CuentasporcobrarController extends Controller
{
    public function index(Request $request)
    {
        $nodes=DB::table('tb_nota_debito as nd')->get();
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
        return view('cobranza.cuenta-por-cobrar.index',["ventas"=>$ventas,"searchText"=>$fact,"vendedores"=>$vendedores,"nodes"=>$nodes]);
    }


    public function create()
    {

    }

    public function store(NotaDebitoFormRequest $request)
    {

    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        $up = $request->get('up_stado');
        if ($up == 1) {
            $venta=Venta::findOrFail($id);
            $venta->estado='Pagada';
            $venta->detalle=$request->get('detalle');
            $venta->save();

            flash('Pago Agregada')->success();
        }
        return Redirect::to('cobranza/cuenta-por-cobrar');
    }
} /* FIN CuentasporcobrarController */
