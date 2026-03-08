<?php

namespace App\Domain\Repositories;

interface TruckRepository
{
    public function findAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);

    public function existsByPlate(string $plate, ?int $ignoreId = null);
}
