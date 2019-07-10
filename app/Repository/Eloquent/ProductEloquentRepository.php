<?php


namespace App\Repository\Eloquent;


use App\Product;
use App\Repository\Contracts\ProductRepositoryInterface;

class ProductEloquentRepository extends Eloquent implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }
}
