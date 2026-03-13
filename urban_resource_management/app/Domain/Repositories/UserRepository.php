<?php

namespace App\Domain\Repositories;

interface UserRepository
{
    public function findAll();
    public function findById(int $id);

    public function findByUsername(string $email);
    public function create(array $data);
    public function update(int $id, array $data);

    public function findByRole(int $roleId);

    public function existsByUsername(string $username, ?int $ignoreId = null);
    public function existsByEmail(string $email, ?int $ignoreId = null);

}
