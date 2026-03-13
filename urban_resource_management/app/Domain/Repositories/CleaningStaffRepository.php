<?php

namespace App\Domain\Repositories;

interface CleaningStaffRepository
{
    public function findAll();
    public function findById(int $id);

    public function findAvailable();
    public function create(array $data);
    public function update(int $id, array $data);

    public function existsByName(string $username, ?int $ignoreId = null);

}
