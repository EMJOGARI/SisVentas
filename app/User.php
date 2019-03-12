<?php

namespace PcArts;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='tb_users';

    protected $primaryKey='id';

    protected $fillable = [
        'idrol', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
