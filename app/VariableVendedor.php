<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class VariableVendedor extends Model
{
    protected $table='tb_variable_vendedor';

    protected $primaryKey='idvar';

    public $timestamps=false;

    protected $fillable =[
    	'idvendedor',
        'cuota_venta',
        'incentivo_venta',
        'cuota_cliente_activar',
        'incentivo_cliente_activar',
        'fecha'
    ];

    protected $guarded =[

    ];
}
