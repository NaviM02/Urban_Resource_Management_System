<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Repositories\TruckRepository;
use App\Domain\Enums\StatusEnum;
use App\Models\Truck;

class DbTruckRepository implements TruckRepository
{

    public function findAll()
    {
        return Truck::with(['truckStatus'])->get();
    }

    public function findById($id)
    {
        return Truck::with(['truckStatus'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Truck::create($data);
    }

    public function update($id, array $data)
    {
        $truck = Truck::findOrFail($id);
        $truck->update($data);

        return $truck;
    }

    public function existsByPlate(string $plate, ?int $ignoreId = null)
    {
        return Truck::where('plate', $plate)
            ->where('status_id', '!=', StatusEnum::DELETED)
            ->when($ignoreId, fn($q) =>
            $q->where('id', '!=', $ignoreId)
            )
            ->exists();
    }
}
