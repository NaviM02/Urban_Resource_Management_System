<?php

namespace App\Domain\Repositories;

interface CollectionPointRepository
{
    public function findAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);

}
