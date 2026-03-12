<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\Container;
use App\Domain\Repositories\ContainerRepository;

class DbContainerRepository implements ContainerRepository
{

    public function findAll()
    {
        return Container::with('greenPoint', 'materialType')->get();
    }

    public function findByGreenPoint($greenPointId)
    {
        return Container::with('materialType')
            ->where('green_point_id',$greenPointId)
            ->get();
    }

    public function findById($id)
    {
        return Container::with(['materialType','greenPoint'])
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return Container::create($data);
    }

    public function update($id, array $data)
    {
        $container = Container::findOrFail($id);

        $container->update($data);

        return $container;
    }

}
