<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Repositories\CollectionRepository;
use App\Models\Collection;
use App\Models\CollectionPoint;

class DbCollectionRepository implements CollectionRepository
{

    public function findAll()
    {
        return Collection::with(['collectionStatus', 'route', 'truck', 'points'])->get();
    }

    public function findById($id)
    {
        return Collection::with(['collectionStatus', 'route', 'truck', 'points'])->findOrFail($id);
    }

    public function findByRouteAndDate($routeId, $date)
    {
        return Collection::where('route_id', $routeId)
            ->where('scheduled_date', $date)
            ->first();
    }

    public function create(array $data)
    {
        return Collection::create($data);
    }

    public function update($id, array $data)
    {
        $collection = Collection::findOrFail($id);
        $collection->update($data);

        return $collection;
    }
}
