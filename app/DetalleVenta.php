<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;
use DB;

class DetalleVenta extends Model
{
    protected $table='tb_detalle_venta';

    protected $primaryKey='iddetalle_venta';

    public $timestamps=false;

    protected $fillable =[
    	'idventa',
        'idarticulo',
        'cantidad',
        'precio_venta',
        'descuento'
    ];

    protected $guarded =[
    	
    ];

    public function scopeSumadetalleventa($query,$venta_id){
        return $query->select('idarticulo',DB::raw("SUM(cantidad) as suma"))
                    ->where('idventa',$venta_id)
                    ->groupBy('idarticulo')
                    ->get();
    }
}
