<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Enums\StatusEnum;
use App\Models\User;
use App\Domain\Repositories\UserRepository;

class DbUserRepository implements UserRepository
{

    public function findAll()
    {
        return User::with('role')->get();
    }

    public function findById(int $id)
    {
        return User::findOrFail($id);
    }

    public function findByUsername(string $email)
    {
        return User::where('username', $email)
            ->with('role')
            ->first();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function existsByUsername(string $username, ?int $ignoreId = null): bool
    {
        return User::where('username', $username)
            ->where('status_id', '!=', StatusEnum::DELETED)
            ->when($ignoreId, fn($q) =>
            $q->where('id', '!=', $ignoreId)
            )
            ->exists();
    }

    public function existsByEmail(string $email, ?int $ignoreId = null): bool
    {
        return User::where('email', $email)
            ->where('status_id', '!=', StatusEnum::DELETED)
            ->when($ignoreId, fn($q) =>
            $q->where('id', '!=', $ignoreId)
            )
            ->exists();
    }
}
