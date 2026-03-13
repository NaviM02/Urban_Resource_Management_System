<?php

namespace App\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\EntityAlreadyExistsException;
use App\Domain\Exceptions\EntityNotFoundException;
use App\Domain\Repositories\CleaningStaffRepository;

class CleaningStaffService
{

    private CleaningStaffRepository $cleaningStaffRepository;

    public function __construct(
        CleaningStaffRepository $cleaningStaffRepository
    ){
        $this->cleaningStaffRepository = $cleaningStaffRepository;
    }

    public function findAll()
    {
        return $this->cleaningStaffRepository->findAll();
    }

    public function findById($id)
    {
        $staff = $this->cleaningStaffRepository->findById($id);

        if(!$staff){
            throw new EntityNotFoundException('Cleaning staff not found');
        }

        return $staff;
    }

    public function create(array $data)
    {
        if($this->cleaningStaffRepository->existsByName($data['name'])){
            throw new EntityAlreadyExistsException('Cleaning staff already exists');
        }

        return $this->cleaningStaffRepository->create($data);
    }

    public function update($id, array $data)
    {
        if(isset($data['name']) &&
            $this->cleaningStaffRepository->existsByName($data['name'], $id)){

            throw new EntityAlreadyExistsException('Cleaning staff already exists');
        }

        return $this->cleaningStaffRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->cleaningStaffRepository->update($id, [
            'status_id' => StatusEnum::DELETED
        ]);
    }

    public function findAvailable()
    {
        return $this->cleaningStaffRepository->findAvailable();
    }

}
