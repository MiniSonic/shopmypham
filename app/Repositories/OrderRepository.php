<?php

namespace App\Repositories;

use App\Model\Entities\Order;
use App\Repositories\Base\BaseRepository;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function validator()
    {
         // return ProductValidator::class;
    }
}
