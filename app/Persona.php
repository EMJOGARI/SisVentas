<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='tb_persona';

    protected $primaryKey='idpersona';

    public $timestamps=false;

    protected $fillable =[
    	'tipo_persona',
    	'nombre',
    	'tipo_documento',
    	'num_documento',
    	'direccion',
    	'telefono',
        'municipio',
        'fecha_creacion',
        'estado'
    ];

    protected $guarded =[

    ];
}
