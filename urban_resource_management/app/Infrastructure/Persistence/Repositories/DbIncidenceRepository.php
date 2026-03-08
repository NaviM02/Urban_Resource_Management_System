<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Repositories\IncidenceRepository;
use App\Models\Incidence;

class DbIncidenceRepository implements IncidenceRepository
{

    public function findAll()
    {
        return Incidence::with(['collection'])->get();
    }

    public function findAllByCollectionId($id)
    {
        return Incidence::with(['collection'])->where('collection_id', $id)->get();
    }

    public function create(array $data)
    {
        return Incidence::create($data);
    }

}
