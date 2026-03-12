<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\GreenPoint;
use App\Domain\Enums\StatusEnum;
use App\Domain\Repositories\GreenPointRepository;

class DbGreenPointRepository implements GreenPointRepository
{

    public function findAll()
    {
        return GreenPoint::with(['status','manager'])->get();
    }

    public function findById($id)
    {
        return GreenPoint::with([
            'status',
            'manager',
            'containers.materialType'
        ])->findOrFail($id);
    }

    public function create(array $data)
    {
        return GreenPoint::create($data);
    }

    public function update($id, array $data)
    {
        $greenPoint = GreenPoint::findOrFail($id);

        $greenPoint->update($data);

        return $greenPoint;
    }

    public function existsByName(string $name, ?int $ignoreId = null)
    {
        return GreenPoint::where('name', $name)
            ->where('status_id','!=',StatusEnum::DELETED)
            ->when($ignoreId, fn($q) =>
            $q->where('id','!=',$ignoreId)
            )
            ->exists();
    }

}
