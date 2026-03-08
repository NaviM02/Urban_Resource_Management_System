<?php

namespace App\Domain\Repositories;

interface CollectionRepository
{
    public function findAll();
    public function findById($id);
    public function findByRouteAndDate($routeId, $date);
    public function create(array $data);
    public function update($id, array $data);

}
