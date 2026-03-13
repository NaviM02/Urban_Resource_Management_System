<?php

namespace App\Application\Services;

use App\Domain\Enums\ZoneTypeEnum;
use App\Domain\Repositories\CollectionRepository;
use App\Domain\Repositories\CollectionPointRepository;
use App\Domain\Enums\CollectionStatusEnum;
use App\Domain\Repositories\IncidenceRepository;
use App\Models\Route;
use Illuminate\Support\Carbon;

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

        return $this->collectionRepository->create($data);
    }

    public function generateCollections($routeId, $truckId, $startDate, $weeks)
    {
        $route = Route::findOrFail($routeId);

        $days = str_split($route->collection_days);

        $start = Carbon::parse($startDate);

        for ($week = 0; $week < $weeks; $week++) {

            for ($day = 0; $day < 7; $day++) {

                if ($days[$day] == '1') {

                    $date = $start->copy()
                        ->startOfWeek()
                        ->addDays($day)
                        ->addWeeks($week);

                    if ($date->lt($start)) {
                        continue;
                    }

                    $this->create([
                        'route_id' => $routeId,
                        'truck_id' => $truckId,
                        'scheduled_date' => $date->format('Y-m-d')
                    ]);
                }
            }
        }
    }

    private function generateCollectionPoints($collection)
    {
        $route = $collection->route;

        $truck = $collection->truck;

        $zoneType = $route->zone->zone_type_id;

        $truckCapacityKg = $truck->capacity_tons * 1000;

        $coordinates = $route->path_coordinates;

        $pointsCount = rand(15, 30);

        $totalWaste = 0;

        for ($i = 0; $i < $pointsCount; $i++) {

            // random segment
            $index = rand(0, count($coordinates) - 2);

            $start = $coordinates[$index];
            $end = $coordinates[$index + 1];

            // random point in segment
            $t = mt_rand() / mt_getrandmax();

            $lat = $start[0] + ($end[0] - $start[0]) * $t;
            $lng = $start[1] + ($end[1] - $start[1]) * $t;

            $waste = $this->generateWaste($zoneType);

            if ($totalWaste + $waste > $truckCapacityKg) {
                $waste = $truckCapacityKg - $totalWaste;
            }

            $this->pointRepository->create([
                'collection_id' => $collection->id,
                'lat' => $lat,
                'lng' => $lng,
                'estimated_kg' => $waste
            ]);

            $totalWaste += $waste;
        }

        $this->collectionRepository->update($collection->id, [
            'estimated_waste_kg' => $totalWaste
        ]);
    }

    private function generateWaste($zoneType)
    {
        switch ($zoneType) {

            case ZoneTypeEnum::RESIDENTIAL:
                $ranges = [
                    ['min'=>50, 'max'=>120, 'prob'=>60],
                    ['min'=>120, 'max'=>200, 'prob'=>30],
                    ['min'=>200, 'max'=>300, 'prob'=>10],
                ];
                break;

            case ZoneTypeEnum::COMMERCIAL:
                $ranges = [
                    ['min'=>80, 'max'=>180, 'prob'=>50],
                    ['min'=>170, 'max'=>260, 'prob'=>35],
                    ['min'=>200, 'max'=>400, 'prob'=>15],
                ];
                break;

            case ZoneTypeEnum::INDUSTRIAL:
                $ranges = [
                    ['min'=>100, 'max'=>200, 'prob'=>40],
                    ['min'=>150, 'max'=>300, 'prob'=>40],
                    ['min'=>200, 'max'=>500, 'prob'=>20],
                ];
                break;
        }

        // probability range
        $rand = rand(1,100);
        $sum = 0;

        foreach($ranges as $range){
            $sum += $range['prob'];

            if($rand <= $sum){
                return rand($range['min'], $range['max']);
            }
        }

        return rand(50,200);
    }

    public function start($id)
    {
        $collection = $this->collectionRepository->findById($id);

        $this->generateCollectionPoints($collection);

        return $this->collectionRepository->update($id, [
            'collection_status_id' => CollectionStatusEnum::IN_PROGRESS,
            'started_at' => now()->format('H:i:s')
        ]);
    }

    public function cancel($id, array $data)
    {
        $data['collection_status_id'] = CollectionStatusEnum::INCOMPLETED;
        $data['finished_at'] = now()->addHours(rand(1,3))->addMinutes(rand(10,50))->format('H:i:s');

        $this->addIncidents($id, $data);

        return $this->collectionRepository->update($id, $data);
    }

    public function finish($id, array $data)
    {
        $data['collection_status_id'] = CollectionStatusEnum::COMPLETED;
        $data['finished_at'] = now()->format('H:i:s');

        $this->addIncidents($id, $data);

        return $this->collectionRepository->update($id, $data);
    }

    private function addIncidents($id, array $data)
    {
        $incidents = $data['incidents'] ?? [];
        unset($data['incidents']);

        foreach ($incidents as $incident) {

            if (trim($incident) !== '') {
                $this->addIncidence($id, $incident);
            }

        }
    }

    public function addIncidence($collectionId, $description)
    {
        return $this->incidenceRepository->create([
            'collection_id' => $collectionId,
            'description' => $description
        ]);
    }

}
