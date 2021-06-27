<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Admin extends AuthTmp
{
    protected $table = 'admin';

    protected $fillable = [
        'id', 'email', 'password', 'role', 'ins_date', 'upd_date', 'del_flag'
    ];
}


















