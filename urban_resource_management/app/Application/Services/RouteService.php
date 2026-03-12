<?php

namespace App\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\EntityAlreadyExistsException;
use App\Domain\Exceptions\EntityNotFoundException;
use App\Domain\Repositories\RouteRepository;

class RouteService
{
    private RouteRepository $routeRepository;

    public function __construct(RouteRepository $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    public function findAll()
    {
        return $this->routeRepository->findAll();
    }

    public function findById($id)
    {
        $route = $this->routeRepository->findById($id);

        if (!$route) {
            throw new EntityNotFoundException('Route not found');
        }

        return $route;
    }

    public function create(array $data)
    {
        if ($this->routeRepository->existsByName($data['name'])) {
            throw new EntityAlreadyExistsException('Route name already exists');
        }

        // convert coordinates
        $coordinates = is_array($data['path_coordinates'])
            ? $data['path_coordinates']
            : json_decode($data['path_coordinates'], true);

        if (!$coordinates || count($coordinates) < 2) {
            throw new \InvalidArgumentException('Route must have at least two coordinates');
        }

        $data['path_coordinates'] = $coordinates;

        // start
        $data['lat_start'] = $coordinates[0][0];
        $data['lng_start'] = $coordinates[0][1];

        // end
        $last = end($coordinates);

        $data['lat_end'] = $last[0];
        $data['lng_end'] = $last[1];

        return $this->routeRepository->create($data);
    }

    public function update($id, array $data)
    {
        if (isset($data['name']) && $this->routeRepository->existsByName($data['name'], $id)) {
            throw new EntityAlreadyExistsException('Route name already exists');
        }

        if(isset($data['path_coordinates'])){

            $coordinates = is_array($data['path_coordinates'])
                ? $data['path_coordinates']
                : json_decode($data['path_coordinates'], true);

            if (!$coordinates || count($coordinates) < 2) {
                throw new \InvalidArgumentException('Route must have at least two coordinates');
            }

            $data['path_coordinates'] = $coordinates;

            $data['lat_start'] = $coordinates[0][0];
            $data['lng_start'] = $coordinates[0][1];

            $last = end($coordinates);

            $data['lat_end'] = $last[0];
            $data['lng_end'] = $last[1];
        }

        return $this->routeRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->routeRepository->update($id, [
            'status_id' => StatusEnum::DELETED
        ]);
    }
}
