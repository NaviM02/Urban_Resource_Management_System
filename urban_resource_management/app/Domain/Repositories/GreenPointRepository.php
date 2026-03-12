<?php

namespace App\Domain\Repositories;

interface GreenPointRepository
{
    public function findAll();
    public function findById($id);
    public function existsByName(string $name, ?int $ignoreId = null);
    public function create(array $data);
    public function update($id, array $data);

}
