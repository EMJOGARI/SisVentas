<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;
use DB;

class DetalleNotaCredito extends Model
{
     protected $table='tb_detalle_noce';

    protected $primaryKey='id_detalle_noce';

    public $timestamps=false;

    protected $fillable =[
        'idnoce',
        'idarticulo',
        'cantidad',
        'descuento',
        'precio_venta'
    ];

    protected $guarded =[

    ];
    public function scopeSumadetallenoce($query,$node_id){
        return $query->select('idarticulo',DB::raw("SUM(cantidad) as suma"))
                    ->where('idnoce',$node_id)
                    ->groupBy('idarticulo')
                    ->get();
    }
}
