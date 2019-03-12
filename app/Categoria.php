<?php

namespace PcArts;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='tb_categoria';

    protected $primaryKey='idcategoria';

    public $timestamps=false;

    protected $fillable =[
    	'nombre',
    	'descripcion',
    	'condicion'
    ];

    protected $guarded =[
    	
    ];
}
