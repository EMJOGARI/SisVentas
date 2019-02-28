<?php

namespace PcArts;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table='roles';

    protected $primaryKey='idrol';

    protected $fillable = [
        'name',
    ];
}
