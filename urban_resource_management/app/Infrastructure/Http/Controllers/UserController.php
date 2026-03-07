<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\UserService;
use App\Models\Role;
use App\View\Support\Toast;
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

        return view('pages.admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('pages.admin.users.form', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required',
            'status_id' => 'required'
        ]);

        $this->userService->create($request->all());

        Toast::success('Usuario creado correctamente');

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = $this->userService->findById($id);

        return view('pages.admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userService->findById($id);
        $roles = Role::all();

        return view('pages.admin.users.form', compact('user'), compact('roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'status_id' => 'required'
        ]);

        $this->userService->update($id, $request->all());

        Toast::success('Usuario actualizado correctamente');
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario eliminado');
    }
}
