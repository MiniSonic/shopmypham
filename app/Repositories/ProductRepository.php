<?php

namespace App\Repositories;

use App\Model\Entities\Product;
use App\Repositories\Base\BaseRepository;
use App\Validators\ProductValidator;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }

    public function validator()
    {
         return ProductValidator::class;
    }
}
