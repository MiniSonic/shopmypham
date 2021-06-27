<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;
use App\Model\Presenters\UserPresenter;

class User extends AuthTmp
{
    use UserPresenter;

    protected $table = 'user';

    protected $fillable = [
        'id', 'username', 'email', 'password', 'address', 'phone', 'status', 'ins_date', 'upd_date', 'del_flag'
    ];
}












