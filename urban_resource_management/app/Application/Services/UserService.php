<?php

namespace App\Application\Services;

use App\Domain\Enums\RoleEnum;
use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\EntityAlreadyExistsException;
use App\Domain\Exceptions\EntityNotFoundException;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findAll()
    {
        return $this->userRepository->findAll();
    }

    public function findCivils()
    {
        return $this->userRepository->findByRole(RoleEnum::CIVIL);
    }

    public function findOperators()
    {
        return $this->userRepository->findByRole(RoleEnum::OPERATOR);
    }

    public function findById($id)
    {
        $user = $this->userRepository->findById($id);
        if(!$user) throw new EntityNotFoundException('Usuario no encontrado');
        return $this->userRepository->findById($id);
    }

    public function create(array $data)
    {
        if ($this->userRepository->existsByUsername($data['username'])) throw new EntityAlreadyExistsException('Nombre de usuario ya existente, utilice otro');
        if ($this->userRepository->existsByEmail($data['email'])) throw new EntityAlreadyExistsException('Email ya existente, utilice otro');


        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['username']) && $this->userRepository->existsByUsername($data['username'], $id)) throw new EntityAlreadyExistsException('Nombre de usuario ya existente, utilice otro');
        if (isset($data['email']) && $this->userRepository->existsByEmail($data['email'], $id)) throw new EntityAlreadyExistsException('Email ya existente, utilice otro');

        return $this->userRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->userRepository->update($id, ['status_id' => StatusEnum::DELETED]);
    }
}
