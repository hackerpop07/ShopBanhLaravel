<?php


namespace App\Repository\Contracts;


interface RepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function create($object);

    public function update($object);

    public function delete($object);
}
