<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class NotaDebito extends Model
{
    protected $table='tb_nota_debito';

    protected $primaryKey='id_node';

    public $timestamps=false;

    protected $fillable =[
    	'idventa',
        'tipo_comprobante',
        'total_debito',
        'fecha'
    ];

    protected $guarded =[

    ];
}
