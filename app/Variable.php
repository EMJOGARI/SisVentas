<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table='tb_variable';

    protected $primaryKey='id_variable';

    public $timestamps=false;

    protected $fillable =[
    	'comision_max',
        'comision_min',
        'meta_cumplir',
        'dia_min',
        'dia_max',
        'objetivo_meta',
        'visita_activa',
        'objetivo_visita'
    ];

    protected $guarded =[

    ];
}
