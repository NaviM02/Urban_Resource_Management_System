<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Models\MaterialDelivery;
use App\Domain\Repositories\MaterialDeliveryRepository;

class DbMaterialDeliveryRepository implements MaterialDeliveryRepository
{

    public function findByGreenPoint($greenPointId)
    {
        return MaterialDelivery::with([
            'container.materialType',
            'user'
        ])
            ->where('green_point_id',$greenPointId)
            ->orderByDesc('delivered_at')
            ->get();
    }

    public function create(array $data)
    {
        return MaterialDelivery::create($data);
    }

}
