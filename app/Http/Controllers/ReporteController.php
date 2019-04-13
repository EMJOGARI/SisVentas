<?php

namespace SisVentas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use DB;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generar()
    {
        
              	//dd($ingresos);
        $view = \View::make('pdf.reporte',compact('tb_articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }  

    public function ReporteArticulo()
    {
        $articulos=DB::table('tb_articulo as a')
            ->join('tb_categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.estado')
            ->get();
        $view = \View::make('pdf.reportearticulo',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

     public function ReporteArticuloPrecio()
    {
        $articulos=DB::table('tb_articulo as art')
            ->join('tb_detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
            ->select('art.codigo','art.nombre','art.stock', DB::raw("MAX(di.precio_venta) AS precio_venta"))
            ->where('art.estado','=','Activo')
            ->where('art.stock','>','0')
            ->groupBy('art.codigo','art.nombre','art.stock')
            ->get(); 
        $view = \View::make('pdf.reportearticuloprecio',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

     public function ReporteIngreso()
    {
       $ingresos=DB::table('tb_ingreso as i')
        	->join('tb_persona as p','i.idproveedor','=','p.idpersona')
        	->join('tb_detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total')) 
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado')           
        	->get();
        	//dd($ingresos);
        $view = \View::make('pdf.reporteingreso',compact('ingresos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');       
    }

    public function ReporteIngresoID($id)
    {
        $ingresos=DB::table('tb_ingreso as i')
        	->join('tb_persona as p','i.idproveedor','=','p.idpersona')
        	->join('tb_detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante', 'i.estado')          
            ->where('di.idingreso','=',$id)
            ->first();                   	
           
       $detalles=DB::table('tb_detalle_ingreso as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.precio_compra')
            ->where('d.idingreso','=',$id)            
            ->get();
        $view = \View::make('pdf.reporteingresoid',compact('ingresos','detalles'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReportePersona()
    {
       $personas=DB::table('tb_persona')
            ->get();
        $view = \View::make('pdf.reportepersona',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    } 

    public function ReporteCliente()
    {
       $personas=DB::table('tb_persona')               
            ->where('tipo_persona','=','Cliente')            
            ->get();
        $view = \View::make('pdf.reportecliente',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }
    public function ReporteProveedor()
    {
       $personas=DB::table('tb_persona')               
            ->where('tipo_persona','=','Proveedor')
            ->get();
        $view = \View::make('pdf.reporteproveedor',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }
    public function ReporteVendedor()
    {
       $personas=DB::table('tb_persona')               
            ->where('tipo_persona','=','Vendedor')
            ->get();
        $view = \View::make('pdf.reportevendedor',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }     
   
    public function ReporteVenta()
    {
       $ventas=DB::table('tb_venta as v')
        	->join('tb_persona as p','v.idcliente','=','p.idpersona')
        	->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.estado','=','A')
        	->get();
        $view = \View::make('pdf.reporteventa',compact('ventas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteVentaID($id)
    {
       $venta=DB::table('tb_venta as v')
            ->join('tb_persona as p','v.idcliente','=','p.idpersona')
            ->join('tb_detalle_venta as dv','v.idventa','=','dv.idventa')
            ->select('v.idventa','v.fecha_hora','p.nombre','p.direccion','p.tipo_documento','p.num_documento','p.telefono','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.estado','v.total_venta')
            ->where('v.idventa','=',$id)
            ->first();

        $detalles=DB::table('tb_detalle_venta as d')
            ->join('tb_articulo as a', 'd.idarticulo', '=','a.idarticulo')
            ->select('a.nombre as articulo', 'd.cantidad', 'd.descuento','d.precio_venta')
            ->where('d.idventa','=',$id)
            ->get();

        $view = \View::make('pdf.reporteventaid',compact('venta','detalles'))->render();
        $paper_size = array(0,0,623.622,433.701); // 'portrait' or 'landscape' 

        $pdf = \App::make('dompdf.wrapper');        
        $pdf->loadHTML($view)->setPaper('landscape'); 
        return $pdf->stream('informe'.'.pdf');
    }
}
