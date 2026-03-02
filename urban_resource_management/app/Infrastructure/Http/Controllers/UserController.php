<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\UserService;
use Illuminate\Http\Request;

class UserController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        $users = $this->userService->findAll();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role_id' => 'required',
            'status_id' => 'required'
        ]);

        $this->userService->create($request->all());

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario creado correctamente');
    }

    public function show($id)
    {
        $user = $this->userService->findById($id);

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->findById($id);

        return view('users.form', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'role_id' => 'required'
        ]);

        $this->userService->update($id, $request->all());

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario actualizado');
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario eliminado');
    }
}
