<?php

namespace App\Application\Services;

use App\Domain\Exceptions\EntityNotFoundException;
use App\Domain\Repositories\ComplaintRepository;
use App\Models\ComplaintAssignment;

class ComplaintService
{

    private ComplaintRepository $complaintRepository;

    public function __construct(
        ComplaintRepository $complaintRepository
    ){
        $this->complaintRepository = $complaintRepository;
    }

    public function findAll()
    {
        return $this->complaintRepository->findAll();
    }

    public function findById($id)
    {
        $complaint = $this->complaintRepository->findById($id);

        if(!$complaint){
            throw new EntityNotFoundException('Complaint not found');
        }

        return $complaint;
    }

    public function create(array $data)
    {
        return $this->complaintRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->complaintRepository->update($id, $data);
    }

    public function assignCleaningTeam(int $complaintId, array $data)
    {

        $complaint = $this->complaintRepository->findById($complaintId);

        if(!$complaint){
            throw new EntityNotFoundException('Complaint not found');
        }

        $assignment = ComplaintAssignment::create([
            'complaint_id' => $complaintId,
            'scheduled_date' => $data['scheduled_date'],
            'estimated_resources' => $data['estimated_resources'] ?? null,
            'notes' => $data['notes'] ?? null
        ]);

        if(isset($data['staff_ids'])){
            $assignment->staff()->attach($data['staff_ids']);
        }

        return $assignment;
    }

}
