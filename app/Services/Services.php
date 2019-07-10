<?php


namespace App\Services;


interface Services
{
    public function getAll();

    public function getProduct($id);

    public function create($request);

    public function update($request, $id);

    public function destroy($request, $id);
}
