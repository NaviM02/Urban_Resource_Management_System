<?php

namespace App\Domain\Repositories;

interface UserRepository
{
    public function findAll();
    public function findById(int $id);

    public function findByUsername(string $email);
    public function create(array $data);
    public function update(int $id, array $data);
}
