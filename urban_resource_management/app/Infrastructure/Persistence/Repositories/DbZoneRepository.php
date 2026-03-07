<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\Zone;
use App\Domain\Enums\StatusEnum;
use App\Domain\Repositories\ZoneRepository;

class DbZoneRepository implements ZoneRepository
{

    public function findAll()
    {
        return Zone::get();
    }

    public function findById($id)
    {
        return Zone::findOrFail($id);
    }

    public function create(array $data)
    {
        return Zone::create($data);
    }

    public function update($id, array $data)
    {
        $zone = Zone::findOrFail($id);
        $zone->update($data);

        return $zone;
    }

    public function existsByName(string $name, ?int $ignoreId = null)
    {
        return Zone::where('name', $name)
            ->where('status_id', '!=', StatusEnum::DELETED)
            ->when($ignoreId, fn($q) =>
            $q->where('id', '!=', $ignoreId)
            )
            ->exists();
    }
}
