<?php


namespace App\Repository\Eloquent;


use App\ProductType;
use App\Repository\Contracts\CategoryRepositoryInterface;

class CategoryEloquentRepository extends Eloquent implements CategoryRepositoryInterface
{

    public function getModel()
    {
        return ProductType::class;
    }
}
