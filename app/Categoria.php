<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='tb_categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=false;

    protected $fillable =[
    	'nombre',
    	'condicion'
    ];

    protected $guarded =[
    	
    ];
}
