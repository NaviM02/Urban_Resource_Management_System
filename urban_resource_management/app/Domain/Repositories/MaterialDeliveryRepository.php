<?php

namespace App\Domain\Repositories;

interface MaterialDeliveryRepository
{
    public function findByGreenPoint($greenPointId);

    public function create(array $data);
}
