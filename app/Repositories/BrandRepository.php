<?php

namespace App\Repositories;

use App\Model\Entities\Brand;
use App\Repositories\Base\BaseRepository;
use App\Validators\BrandValidator;

class BrandRepository extends BaseRepository
{
    public function model()
    {
        return Brand::class;
    }

    public function validator()
    {
         return BrandValidator::class;
    }
}