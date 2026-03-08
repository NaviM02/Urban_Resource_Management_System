<?php

namespace App\Domain\Repositories;

interface IncidenceRepository
{
    public function findAll();
    public function findAllByCollectionId($id);
    public function create(array $data);

}
