<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table='tb_articulo';

    protected $primaryKey='idarticulo';

    public $timestamps=false;

    protected $fillable =[
    	'idcategoria',
    	'codigo',
    	'nombre',
    	'stock',
    	'costo',
    	'estado'
    ];
/*configurado*/
    protected $guarded =[

    ];
}
