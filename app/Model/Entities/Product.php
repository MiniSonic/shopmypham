<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Product extends AuthTmp
{
    protected $table = 'product';

    protected $fillable = [
        'id', 'branch_id', 'category_id', 'name', 'price_origin', 'price_sell', 'sale', 'avatar',
        'cpu', 'ram', 'sort_describe', 'ins_date', 'upd_date', 'del_flag', 'hot'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}












