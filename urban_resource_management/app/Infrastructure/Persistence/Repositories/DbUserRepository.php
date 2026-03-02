<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\User;
use App\Domain\Repositories\UserRepository;

class DbUserRepository implements UserRepository
{

    public function findAll()
    {
        return User::all();
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
}
