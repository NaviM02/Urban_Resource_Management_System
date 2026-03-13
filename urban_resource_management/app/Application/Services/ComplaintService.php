<?php

namespace App\Application\Services;

use App\Domain\Enums\ComplaintStatusEnum;
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
        $complaint = $this->findById($complaintId);

        if($complaint->complaint_status_id !== ComplaintStatusEnum::REVIEW){
            throw new \Exception('La denuncia no está en revisión');
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

        $this->complaintRepository->update($complaintId, [
            'complaint_status_id' => ComplaintStatusEnum::ASSIGNED
        ]);

        return $assignment;
    }

    public function startReview(int $complaintId)
    {
        $complaint = $this->findById($complaintId);

        if($complaint->complaint_status_id !== ComplaintStatusEnum::RECEIVE){
            return $complaint;
        }

        return $this->complaintRepository->update($complaintId, [
            'complaint_status_id' => ComplaintStatusEnum::REVIEW
        ]);
    }

    public function startCleaning(int $complaintId)
    {
        $complaint = $this->findById($complaintId);

        if($complaint->complaint_status_id !== ComplaintStatusEnum::ASSIGNED){
            throw new \Exception('La denuncia no está asignada');
        }

        $assignment = $complaint->assignment;

        if(!$assignment){
            throw new \Exception('No hay asignación registrada');
        }

        $assignment->update([
            'started_at' => now()
        ]);

        return $this->complaintRepository->update($complaintId, [
            'complaint_status_id' => ComplaintStatusEnum::IN_PROGRESS
        ]);
    }

    public function markAttended(int $complaintId)
    {
        $complaint = $this->findById($complaintId);

        if($complaint->complaint_status_id !== ComplaintStatusEnum::IN_PROGRESS){
            throw new \Exception('La limpieza aún no está en proceso');
        }

        $assignment = $complaint->assignment;

        $assignment->update([
            'finished_at' => now()
        ]);

        return $this->complaintRepository->update($complaintId, [
            'complaint_status_id' => ComplaintStatusEnum::ATTENDED
        ]);
    }

    public function closeComplaint(int $complaintId, array $data)
    {
        $complaint = $this->findById($complaintId);

        if($complaint->complaint_status_id !== ComplaintStatusEnum::ATTENDED){
            throw new \Exception('La denuncia aún no ha sido atendida');
        }

        return $this->complaintRepository->update($complaintId, [
            'complaint_status_id' => ComplaintStatusEnum::CLOSED,
            'photo_after' => $data['photo_after'] ?? null
        ]);
    }


    public function findByCitizen(int $citizenId)
    {
        return $this->complaintRepository->findByCitizen($citizenId);
    }


}
