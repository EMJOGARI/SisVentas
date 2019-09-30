<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleNotaDebito extends Model
{
    protected $table='tb_detalle_node';

    protected $primaryKey='id_detalle_node';

    public $timestamps=false;

    protected $fillable =[
        'id_nota_debito',
        'idarticulo',
        'cantidad',
        'descuento',
        'precio_venta'        
    ];

    protected $guarded =[
        
    ];
}
