<?php

namespace App\Application\Services;

use App\Domain\Repositories\CollectionRepository;
use App\Domain\Repositories\CollectionPointRepository;
use App\Domain\Enums\CollectionStatusEnum;
use App\Domain\Repositories\IncidenceRepository;

class CollectionService
{
    private CollectionRepository $collectionRepository;
    private CollectionPointRepository $pointRepository;
    private IncidenceRepository $incidenceRepository;

    public function __construct(
        CollectionRepository      $collectionRepository,
        CollectionPointRepository $pointRepository,
        IncidenceRepository       $incidenceRepository
    )
    {
        $this->collectionRepository = $collectionRepository;
        $this->pointRepository = $pointRepository;
        $this->incidenceRepository = $incidenceRepository;
    }

    public function findAll()
    {
        return $this->collectionRepository->findAll();
    }

    public function findById($id)
    {
        return $this->collectionRepository->findById($id);
    }

    public function create(array $data)
    {
        $data['collection_status_id'] = CollectionStatusEnum::SCHEDULED;

        $collection = $this->collectionRepository->create($data);

        $this->generateCollectionPoints($collection);

        return $collection;
    }

    private function generateCollectionPoints($collection)
    {
        $route = $collection->route;

        $coordinates = $route->path_coordinates;

        $pointsCount = rand(15, 30);

        $totalWaste = 0;

        for ($i = 0; $i < $pointsCount; $i++) {

            $coord = $coordinates[array_rand($coordinates)];

            $waste = rand(50, 500);

            $this->pointRepository->create([
                'collection_id' => $collection->id,
                'lat' => $coord[0],
                'lng' => $coord[1],
                'estimated_kg' => $waste
            ]);

            $totalWaste += $waste;
        }

        $this->collectionRepository->update($collection->id, [
            'estimated_waste_kg' => $totalWaste
        ]);
    }

    public function start($id)
    {
        return $this->collectionRepository->update($id, [
            'collection_status_id' => CollectionStatusEnum::IN_PROGRESS,
            'started_at' => now()->format('H:i:s')
        ]);
    }

    public function cancel($id, array $data)
    {
        $data['collection_status_id'] = CollectionStatusEnum::INCOMPLETED;
        $data['finished_at'] = now()->format('H:i:s');

        return $this->collectionRepository->update($id, $data);
    }

    public function finish($id, array $data)
    {
        $data['collection_status_id'] = CollectionStatusEnum::COMPLETED;
        $data['finished_at'] = now()->format('H:i:s');

        return $this->collectionRepository->update($id, $data);
    }

    public function addIncidence($collectionId, $description)
    {
        return $this->incidenceRepository->create([
            'collection_id' => $collectionId,
            'description' => $description
        ]);
    }

}
