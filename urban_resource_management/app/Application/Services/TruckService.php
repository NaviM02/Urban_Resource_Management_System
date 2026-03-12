<?php

namespace App\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\EntityAlreadyExistsException;
use App\Domain\Repositories\TruckRepository;

class TruckService
{
    private TruckRepository $truckRepository;

    public function __construct(TruckRepository $truckRepository)
    {
        $this->truckRepository = $truckRepository;
    }

    public function findAll()
    {
        return $this->truckRepository->findAll();
    }

    public function findById($id)
    {
        return $this->truckRepository->findById($id);
    }

    public function create(array $data)
    {
        if ($this->truckRepository->existsByPlate($data['plate'])) {
            throw new EntityAlreadyExistsException('Truck plate already exists');
        }

        return $this->truckRepository->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['plate']) &&
            $this->truckRepository->existsByPlate($data['plate'], $id)) {
            throw new EntityAlreadyExistsException('Truck plate already exists');
        }

        return $this->truckRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->truckRepository->update($id, [
            'status_id' => StatusEnum::DELETED
        ]);
    }
}
