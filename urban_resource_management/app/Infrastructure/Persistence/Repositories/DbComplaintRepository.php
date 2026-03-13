<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\Complaint;
use App\Domain\Repositories\ComplaintRepository;

class DbComplaintRepository implements ComplaintRepository
{

    public function findAll()
    {
        return Complaint::with(['citizen', 'status', 'assignment'])->get();
    }

    public function findById($id)
    {
        return Complaint::with(['citizen', 'status', 'assignment.staff'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Complaint::create($data);
    }

    public function update($id, array $data)
    {
        $complaint = Complaint::findOrFail($id);

        $complaint->update($data);

        return $complaint;
    }

}
