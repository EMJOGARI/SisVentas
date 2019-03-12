<?php

namespace PcArts;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $table='tb_detalle_ingreso';

    protected $primaryKey='iddetalle_ingreso';

    public $timestamps=false;

    protected $fillable =[
    	'idingreso',
        'idarticulo',
        'cantidad',
        'precio_compra',
        'precio_venta'
    ];

    protected $guarded =[
    	
    ];

    /*public static function UpdateArticuloCosto(){
        $UpdateArticulo=DB::table('detalle_ingreso as di')
            ->join('articulo as a','a.idcategoria','=','c.idcategoria')
            ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.costo','c.nombre as categoria','a.descripcion','a.estado')
            ->where('a.nombre','LIKE','%'.$query.'%') 
            ->orwhere('a.codigo','LIKE','%'.$query.'%')            
            ->orderBy('a.idarticulo','desc')
            ->paginate(8);
    }*/
}
/*
UPDATE 
detalle_ingreso di, articulo a SET a.costo = di.precio_venta
WHERE a.idarticulo = di.idarticulo AND di.iddetalle_ingreso = (SELECT iddetalle_ingreso FROM detalle_ingreso WHERE detalle_ingreso.idarticulo = a.idarticulo AND detalle_ingreso.precio_venta > a.costo ORDER BY iddetalle_ingreso DESC LIMIT 1)*/