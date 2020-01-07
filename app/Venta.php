<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='tb_venta';

    protected $primaryKey='idventa';

    public $timestamps=false;

    protected $fillable =[
    	'idcliente',
        'idvendedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'fecha_entrega',
        'fecha_pagada',
        'total_venta',
        'estado',
        'detalle',
        'idnoce',
        'total_noce',
        'dias_pago'
    ];

    protected $guarded =[

    ];
}
