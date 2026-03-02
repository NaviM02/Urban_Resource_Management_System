<?php

namespace App\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $credentials)
    {
        $user = $this->userRepository
            ->findByUsername($credentials['username']);

        if (!$user || $user->estado_id === StatusEnum::DELETED) throw new Exception('Usuario no encontrado');

        if (!Hash::check($credentials['password'], $user->password)) throw new Exception('Contraseña incorrecta');

        if ($user->estado_id === StatusEnum::INACTIVE) throw new Exception('Usuario inactivo');

        Auth::login($user);
        Auth::user()->loadMissing('role');

        return $user;
    }

    public function logout()
    {
        Auth::logout();
    }
}
