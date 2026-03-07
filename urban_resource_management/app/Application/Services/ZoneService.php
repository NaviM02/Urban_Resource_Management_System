<?php

namespace App\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\EntityAlreadyExistsException;
use App\Domain\Exceptions\EntityNotFoundException;
use App\Domain\Repositories\ZoneRepository;

class ZoneService
{
    private ZoneRepository $zoneRepository;

    public function __construct(ZoneRepository $zoneRepository)
    {
        $this->zoneRepository = $zoneRepository;
    }

    public function findAll()
    {
        return $this->zoneRepository->findAll();
    }

    public function findById($id)
    {
        $zone = $this->zoneRepository->findById($id);

        if (!$zone) {
            throw new EntityNotFoundException('Zone not found');
        }

        return $zone;
    }

    public function create(array $data)
    {
        if ($this->zoneRepository->existsByName($data['name'])) {
            throw new EntityAlreadyExistsException('Zone name already exists');
        }

        $data['status_id'] = StatusEnum::ACTIVE;

        return $this->zoneRepository->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['name']) && $this->zoneRepository->existsByName($data['name'], $id)) {
            throw new EntityAlreadyExistsException('Zone name already exists');
        }

        return $this->zoneRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->zoneRepository->update($id, [
            'status_id' => StatusEnum::DELETED
        ]);
    }
}
