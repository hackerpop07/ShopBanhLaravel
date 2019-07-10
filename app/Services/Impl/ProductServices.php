<?php


namespace App\Services\Impl;


use App\Repository\Contracts\ProductRepositoryInterface;
use App\Services\Services;

class ProductServices implements Services
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        $result = $this->productRepository->getAll();
        return $result;
    }

    public function getProduct($id)
    {
        // TODO: Implement getProduct() method.
    }

    public function create($request)
    {
        // TODO: Implement create() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request, $id)
    {
        // TODO: Implement destroy() method.
    }
}
