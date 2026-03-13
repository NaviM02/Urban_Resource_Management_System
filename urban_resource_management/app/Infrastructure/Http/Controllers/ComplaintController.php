<?php

namespace App\Infrastructure\Http\Controllers;

use App\Application\Services\ComplaintService;
use App\Application\Services\CleaningStaffService;
use App\Domain\Enums\ComplaintStatusEnum;
use App\View\Support\Toast;
use Illuminate\Http\Request;

class ComplaintController
{

    private ComplaintService $complaintService;
    private CleaningStaffService $cleaningStaffService;

    public function __construct(
        ComplaintService $complaintService,
        CleaningStaffService $cleaningStaffService
    ){
        $this->complaintService = $complaintService;
        $this->cleaningStaffService = $cleaningStaffService;
    }

    // ADMIN LIST
    public function index()
    {
        $complaints = $this->complaintService->findAll();

        return view(
            'pages.admin.complaints.index',
            compact('complaints')
        );
    }

    // CITIZEN LIST
    public function citizenIndex()
    {
        $complaints = $this->complaintService->findByCitizen(auth()->id());

        return view(
            'pages.citizen.complaints.index',
            compact('complaints')
        );
    }

    // CREATE FORM
    public function create()
    {
        return view('pages.citizen.complaints.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'dump_size' => 'required',
            'address' => 'nullable',
            'lat' => 'nullable',
            'lng' => 'nullable'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {

            $path = $request->file('photo')->store(
                'complaints',
                'public'
            );
            $data['photo_path'] = $path;
        }

        $data['citizen_id'] = auth()->id();
        $data['complaint_status_id'] = ComplaintStatusEnum::RECEIVE;
        $data['complaint_date'] = now();

        $this->complaintService->create($data);

        Toast::success('Denuncia registrada');

        return redirect()->route('citizen.complaints.index');
    }

    public function show($id)
    {
        $complaint = $this->complaintService->findById($id);

        $staff = $this->cleaningStaffService->findAvailable();

        return view(
            'pages.admin.complaints.show',
            compact('complaint','staff')
        );
    }

    public function citizenShow($id)
    {
        $complaint = $this->complaintService->findById($id);

        return view(
            'pages.citizen.complaints.show',
            compact('complaint')
        );
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'scheduled_date' => 'required',
            'staff_ids' => 'required|array'
        ]);

        $this->complaintService->assignCleaningTeam($id, $request->all());

        Toast::success('Cuadrilla asignada');

        return back();
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'complaint_status_id' => 'required'
        ]);

        $this->complaintService->update($id, [
            'complaint_status_id' => $request->complaint_status_id
        ]);

        Toast::success('Estado actualizado');

        return back();
    }

}
