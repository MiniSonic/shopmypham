<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Brand extends AuthTmp
{
    protected $table = 'brand';

    protected $fillable = [
        'id', 'name', 'slug', 'avatar', 'ins_date', 'upd_date', 'del_flag'
    ];
}












