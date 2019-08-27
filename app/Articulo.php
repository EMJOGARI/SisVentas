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
    public function scopeBuscartext ($query, $searchText)
    {
        //dd($searchText);
        if ($searchText != "")
        {
            return $query->where('codigo','=',$searchText);
        }

    }

    public function scopeBuscarstock ($query, $searchList)
    {
        dd($searchList);
        if ($searchList = 2)
        {
            return $query->where('stock','<=',$searchList);
        }else{
            return $query->where('stock','>',$searchList);
        }

    }

}
