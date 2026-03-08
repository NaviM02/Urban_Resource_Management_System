<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Repositories\CollectionPointRepository;
use App\Models\CollectionPoint;

class DbCollectionPointRepository implements CollectionPointRepository
{

    public function findAll()
    {
        return CollectionPoint::with(['collection'])->get();
    }

    public function findById($id)
    {
        return CollectionPoint::with(['collection'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return CollectionPoint::create($data);
    }

    public function update($id, array $data)
    {
        $point = CollectionPoint::findOrFail($id);
        $point->update($data);

        return $point;
    }
}
