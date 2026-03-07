<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\Route;
use App\Domain\Enums\StatusEnum;
use App\Domain\Repositories\RouteRepository;

class DbRouteRepository implements RouteRepository
{

    public function findAll()
    {
        return Route::with(['zone', 'wasteType'])->get();
    }

    public function findById($id)
    {
        return Route::with(['zone', 'wasteType'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Route::create($data);
    }

    public function update($id, array $data)
    {
        $route = Route::findOrFail($id);
        $route->update($data);

        return $route;
    }

    public function existsByName(string $name, ?int $ignoreId = null)
    {
        return Route::where('name', $name)
            ->where('status_id', '!=', StatusEnum::DELETED)
            ->when($ignoreId, fn($q) =>
            $q->where('id', '!=', $ignoreId)
            )
            ->exists();
    }
}
