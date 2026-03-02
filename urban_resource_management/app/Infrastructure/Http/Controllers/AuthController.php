<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\AuthService;
use Illuminate\Http\Request;

class AuthController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        try {
            $this->authService->login($request->only('username', 'password'));
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        $this->authService->logout();

        return redirect()->route('login');
    }

    public function showLogin()
    {
        return view('auth.login');
    }
}
