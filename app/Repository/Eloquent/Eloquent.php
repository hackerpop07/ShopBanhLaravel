<?php


namespace App\Repository\Eloquent;


use App\Repository\Contracts\RepositoryInterface;

abstract class Eloquent implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
        $result = $this->getModel()::paginate(8);
        return $result;
    }

    public function findById($id)
    {
        $result = $this->getModel()::findOrFail($id);
        return $result;
    }

    public function create($object)
    {
        $object->save();
    }

    public function update($object)
    {
        $object->save();
    }

    public function delete($object)
    {
        $object->delete();
    }
}
