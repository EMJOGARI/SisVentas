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

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noces=DB::table('tb_nota_credito')->where('estado','Activo')->get();
        $clientes=DB::table('tb_persona')->orderBy('idpersona')->get();
        $vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();

        $fact=trim($request->get('searchText'));
        $vende = $request->get('searchVendedor');
        $clien = $request->get('cliente');

        $ventas=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_persona as p2','p2.idpersona','v.idvendedor')
            ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idvendedor','v.idventa','v.fecha_hora','p.nombre','p2.nombre as vendedor','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where(function($query) use ($fact,$clien,$vende){
                if($fact){
                    if ($fact != "") {
                        return $query->where('v.serie_comprobante',$fact);
                    }
                }
                if ($clien) {
                        if ($clien != "") {
                             return $query->where('p.idpersona',$clien);
                        }
                    }
                if ($vende) {
                    if ($vende != "") {
                         return $query->where('v.idvendedor',$vende);
                    }
                }
            })
            ->where('v.estado','Pagada')
            ->groupBy('v.idvendedor','v.idventa','v.fecha_hora','p.nombre','p2.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->orderBy('idventa','desc')
            ->paginate(20);
            //dd($ventas);
        return view('cobranza.banco.index',["ventas"=>$ventas,"searchText"=>$fact,"clientes"=>$clientes,"vendedores"=>$vendedores,"noces"=>$noces]);
    }
}/*Fin BancoController*/
