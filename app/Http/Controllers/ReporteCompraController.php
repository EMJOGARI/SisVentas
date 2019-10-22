<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use SisVentas\Http\Requests;
use SisVentas\Articulo;
use SisVentas\Http\Requests\ArticuloFormRequest;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection as Collection;


class ReporteCompraController extends Controller
{
    public function reporte_compra_proveedor(Request $request)
    {
    	$proveedor=DB::table('tb_persona')->orderBy('idpersona')->where('tipo_persona','Proveedor')->get();

        $f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

        $prove = $request->get('searchProveedor');
        $muni = $request->get('municipio');

    	$ingresos=DB::table('tb_ingreso as i')
            	->join('tb_persona as p','p.idpersona','i.idproveedor')
            	->join('tb_detalle_ingreso as di','di.idingreso','i.idingreso')
            	->select('i.idingreso','i.idproveedor','i.fecha_hora','p.nombre','p.municipio','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado'
                    ,'i.total_compra')
            	->where(function($query) use ($prove,$muni,$f1,$f2){
                    if (($f1) & ($f2)) {
                        if (($f1 != "") & ($f2 != "") & ($prove != "")) {
                            return $query->WhereBetween('i.fecha_hora', [$f1,$f2])
                                            ->where(function($q) use ($clien,$muni){
                                                $q->orWhere('p.idpersona',$prove)
                                                ->orWhere('p.municipio',$muni);
                                            });
                        }else{
                            if (($f1 != "") & ($f2 != "")){
                                return $query->WhereBetween('i.fecha_hora', [$f1,$f2]);
                            }else{
                                return $query->whereMonth('i.fecha_hora', date('m'));
                            }
                        }
                    }
                    if ($prove) {
                        if ($prove != "") {
                             return $query->where('p.idpersona',$prove);
                        }
                    }
                    if ($muni) {
                        if ($muni != "") {
                             return $query->where('p.municipio',$muni);
                        }
                    }
                })
                ->where('i.estado','A')
            	->orderBy('idingreso','desc')
                ->groupBy('i.idingreso','i.fecha_hora','p.nombre','p.municipio','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado', 'i.total_compra')
                ->paginate(50);

        $sum_total_compra = 0;
        foreach ($ingresos as $ing) {
            $sum_total_compra += $ing->total_compra;
        }
           //dd($ingresos);
        return view('reporte.compra.compra-proveedor.index',compact('ingresos','proveedor','sum_total_compra'));         
    }
}
