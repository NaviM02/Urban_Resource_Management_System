<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Enums\StatusEnum;
use App\Models\CleaningStaff;
use App\Domain\Repositories\CleaningStaffRepository;

class DbCleaningStaffRepository implements CleaningStaffRepository
{

    public function findAll()
    {
        return CleaningStaff::get();
    }

    public function findById(int $id)
    {
        return CleaningStaff::findOrFail($id);
    }

    public function create(array $data)
    {
        return CleaningStaff::create($data);
    }

    public function update(int $id, array $data)
    {
        $staff = CleaningStaff::findOrFail($id);
        $staff->update($data);

        return $staff;
    }

    public function findAvailable()
    {
        return CleaningStaff::where('available', true)
            ->where('status_id', '!=', StatusEnum::DELETED)
            ->get();
    }

    public function existsByName(string $name, ?int $ignoreId = null)
    {
        return CleaningStaff::where('name', $name)
            ->where('status_id', '!=', StatusEnum::DELETED)
            ->when($ignoreId, fn($q) =>
            $q->where('id', '!=', $ignoreId)
            )
            ->exists();
    }

}
