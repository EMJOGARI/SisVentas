<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;
use DB;

class DetalleNotaDebito extends Model
{
   /* protected $table='tb_detalle_node';

    protected $primaryKey='id_detalle_node';

    public $timestamps=false;

    protected $fillable =[
        'id_node',
        'idarticulo',
        'cantidad',
        'descuento',
        'precio_venta'
    ];

    protected $guarded =[

    ];
    public function scopeSumadetallenode($query,$node_id){
        return $query->select('idarticulo',DB::raw("SUM(cantidad) as suma"))
                    ->where('id_node',$node_id)
                    ->groupBy('idarticulo')
                    ->get();
    }
    */
}
