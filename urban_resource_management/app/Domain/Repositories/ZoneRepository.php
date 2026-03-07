<?php

namespace App\Domain\Repositories;

interface ZoneRepository
{
    public function findAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);

    public function existsByName(string $name, ?int $ignoreId = null);
}
