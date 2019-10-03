<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class RankingController extends Controller
{
	/***********************/
	/* RANKING DE CLIENTES */
	/***********************/
    public function ranking_cliente(Request $request)
    {
    	$vendedores=DB::table('tb_persona')->where('tipo_persona','Vendedor')->get();
    	$vende = trim($request->get('searchVendedor'));

    	$f1 = Carbon::now()->toDateString("FechaInicio");
        $f2 = Carbon::now()->toDateString("FechaFinal");

        $f1=$request->get('FechaInicio');
        $f2=$request->get('FechaFinal');

        $date = Carbon::now();

    	if($f1 != ""){
    		$fecha = $request->get('FechaInicio');    		
    	}else{
    		$fecha = $date->format('Y-m-01');
    	}
    	
        $ranking=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_persona as p2','p2.idpersona','v.idvendedor')
            ->select('v.idcliente','p.nombre','p2.nombre as vendedor',
            	DB::raw("SUM(v.total_venta) as total")
            ,DB::raw("(select sum(total_venta) from tb_venta where estado = 'Pagada' and idcliente = v.idcliente and fecha_hora >= '$fecha') as pagadas")
            	,DB::raw("(select sum(total_venta) from tb_venta where estado = 'Pendiente' and idcliente = v.idcliente) as pendientes")
            )
           	->where(function($query) use ($vende, $f1, $f2){           		
                if (($f1) & ($f2)) {
                    if (($f1 != "") & ($f2 != "") & ($vende != "")) {
                        return $query->WhereBetween('v.fecha_hora', [$f1,$f2])
                                    ->where(function($q) use ($vende){
                                        $q->Where('v.idvendedor',$vende);
                                    });
                    }else{
                        if (($f1 != "") & ($f2 != "")){
                            return $query->WhereBetween('v.fecha_hora', [$f1,$f2]);
                        }else{
                            return $query->whereMonth('v.fecha_hora', date('m'));
                        }
                    }
                }
                if ($vende) {
                    if ($vende != "") {
                        return $query->where('v.idvendedor',$vende)
                                    ->where(function($q){
                                        $q->whereMonth('v.fecha_hora', date('m'));
                                    });
                    }
                }else{
                	return $query->whereMonth('v.fecha_hora', date('m'));
                }
            })
			->where([
			    ['v.estado','<>','Anulada'],
			    ['v.estado','<>','Eliminada'],
			])
            ->groupBy('v.idcliente','p.nombre','p2.nombre')
            ->orderBy('total','desc')
            ->get();
            $sum_total = 0;
            $sum_total_c = 0;
            $sum_total_p = 0;
            $k =0;
            foreach ($ranking as $rank) {
                $sum_total += $rank->total;
                $sum_total_c += $rank->pagadas;
                $sum_total_p += $rank->pendientes;
            }
            //dd($ranking);

        return view('reporte.ranking.cliente.index', ["ranking"=>$ranking,"sum_total"=>$sum_total,"sum_total_c"=>$sum_total_c,"sum_total_p"=>$sum_total_p,"k"=>$k,"vendedores"=>$vendedores]);
    }
/*************************/
/* RANKING POR MUNICIPIO */
/*************************/
    public function ranking_municipio()
    {
        $ranking_municipios=DB::table('tb_venta as v')
            ->join('tb_persona as p','p.idpersona','v.idcliente')
            ->join('tb_persona as p2','p2.idpersona','v.idvendedor')
            ->select('p.municipio','p2.nombre',DB::raw("SUM(v.total_venta) as total"))
            ->whereMonth('v.fecha_hora', date('m'))
            ->where('v.estado','<>','Anulada')
            ->where('v.estado','<>','Eliminada')
            ->groupBy('p.municipio','p2.nombre')
            ->orderBy('total','desc')
            ->get();
           // dd($ranking_municipio);
            $sum_total_municipio = 0;
            $m =0;
            foreach ($ranking_municipios as $rank) {
                $sum_total_municipio += $rank->total;
            }
        return view('reporte.ranking.municipio.index', ["ranking_municipios"=>$ranking_municipios,"sum_total_municipio"=>$sum_total_municipio,"m"=>$m]);
    }
}
