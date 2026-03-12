<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\MaterialType;
use App\Domain\Repositories\MaterialTypeRepository;

class DbMaterialTypeRepository implements MaterialTypeRepository
{

    public function findAll()
    {
        return MaterialType::orderBy('name')->get();
    }

}
