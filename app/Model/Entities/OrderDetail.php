<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class OrderDetail extends AuthTmp
{
    protected $table = 'order_detail';

    protected $fillable = [
        'id', 'order_id', 'product_id', 'product_name', 'product_price_origin',
        'product_price_sell', 'product_sale', 'product_quantity', 'product_sort_describe', 'ins_date', 'upd_date', 'del_flag'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}












