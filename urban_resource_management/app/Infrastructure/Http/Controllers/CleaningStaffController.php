<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\CleaningStaffService;
use App\Domain\Enums\StatusEnum;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class CleaningStaffController
{

    private CleaningStaffService $cleaningStaffService;

    public function __construct(
        CleaningStaffService $cleaningStaffService
    ){
        $this->cleaningStaffService = $cleaningStaffService;
    }

    public function index()
    {
        $staff = $this->cleaningStaffService->findAll();

        return view(
            'pages.admin.cleaning-staff.index',
            compact('staff')
        );
    }

    public function create()
    {
        return view('pages.admin.cleaning-staff.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable'
        ]);

        $this->cleaningStaffService->create([
            'name' => $request->name,
            'phone' => $request->phone,
            'available' => true,
            'status_id' => StatusEnum::ACTIVE
        ]);

        Toast::success('Empleado creado correctamente');

        return redirect()->route('cleaning-staff.index');
    }

    public function show($id)
    {
        $staff = $this->cleaningStaffService->findById($id);

        return view(
            'pages.admin.cleaning-staff.show',
            compact('staff')
        );
    }

    public function edit($id)
    {
        $staff = $this->cleaningStaffService->findById($id);

        return view(
            'pages.admin.cleaning-staff.form',
            compact('staff')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'available' => 'required|boolean'
        ]);

        $this->cleaningStaffService->update($id, $request->all());

        Toast::success('Empleado actualizado');

        return redirect()->route('cleaning-staff.index');
    }

    public function destroy($id)
    {
        $this->cleaningStaffService->delete($id);

        Toast::success('Empleado eliminado');

        return redirect()->route('cleaning-staff.index');
    }

}
