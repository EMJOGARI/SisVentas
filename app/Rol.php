<?php

namespace SisVentas;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='tb_roles';

    protected $primaryKey='idrol';

    protected $fillable = [
        'name',
    ];
}
