<?php

namespace App\Model\Entities;

use App\Model\Base\Auth\AuthTmp;

class Cart extends AuthTmp
{
    protected $table = 'cart';

    protected $fillable = [
        'id', 'product_id', 'user_id', 'ins_date', 'upd_date'
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
