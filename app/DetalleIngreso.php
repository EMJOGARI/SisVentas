<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;
use DB;

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
        'precio_venta',
        'precio_credito'
    ];

    protected $guarded =[

    ];

    public function scopeSumadetalleingreso($query,$ingreso_id){
        return $query->select('idarticulo',DB::raw("SUM(cantidad) as suma"))
                    ->where('idingreso',$ingreso_id)
                    ->groupBy('idarticulo')
                    ->get();
    }

}
