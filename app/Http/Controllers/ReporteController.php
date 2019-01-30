<?php

namespace PcArts\Http\Controllers;

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
        $personas=DB::table('persona')
            ->where('tipo_persona','=','Proveedor')
            ->get();
        dd($personas);
        $view = \View::make('pdf.reporte',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteArticulo()
    {
        $articulos=DB::table('articulo as a')
            ->join('categoria as c','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','','a.costo','c.nombre as categoria','a.estado',DB::raw('sum(a.stock*di.precio_compra) as total'))
            ->get();
        $view = \View::make('pdf.reportearticulo',compact('articulos'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');

    }

    public function ReporteClientes()
    {
        $personas=DB::table('persona')
            ->where('tipo_persona','=','Cliente')
            ->get();
        $view = \View::make('pdf.reportecliente',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteProveedor()
    {
        $personas=DB::table('persona')
            ->where('tipo_persona','=','Proveedor')
            ->get();
        $view = \View::make('pdf.reporteproveedor',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteIngreso()
    {
        $ingresos=DB::table('ingreso as i')
            ->join('persona as p','i.idproveedor','=','p.idpersona')
            ->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
            ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.estado',DB::raw('sum(di.cantidad*di.precio_compra) as total'))
            ->get();
        $view = \View::make('pdf.reporteproveedor',compact('personas'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view); 
        return $pdf->stream('informe'.'.pdf');
    }

    public function ReporteIngresoID()
    {
        
    }

    public function ReporteVenta()
    {
        
    }

    public function ReporteVentaID()
    {
        
    }

    public function ReporteUsuario()
    {
        
    }

    

}
