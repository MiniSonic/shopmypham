<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Order extends AuthTmp
{
    protected $table = 'order';

    protected $fillable = [
        'id', 'user_id', 'total_money', 'address', 'phone', 'status', 'ins_date', 'upd_date', 'del_flag', 'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}












