<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class NotaCredito extends Model
{
    protected $table='tb_nota_credito';

    protected $primaryKey='idnoce';

    public $timestamps=false;

    protected $fillable =[
    	'idventa',
        'tipo',
        'num_noce',
        'serie_noce',
        'total_noce',
        'fecha',
        'estado'
    ];

    protected $guarded =[

    ];
}
