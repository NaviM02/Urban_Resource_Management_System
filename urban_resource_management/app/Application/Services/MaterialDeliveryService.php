<?php

namespace App\Application\Services;

use App\Domain\Repositories\ContainerRepository;
use App\Domain\Repositories\MaterialDeliveryRepository;

class MaterialDeliveryService
{

    private MaterialDeliveryRepository $deliveryRepository;
    private ContainerRepository $containerRepository;

    public function __construct(
        MaterialDeliveryRepository $deliveryRepository,
        ContainerRepository $containerRepository
    )
    {
        $this->deliveryRepository = $deliveryRepository;
        $this->containerRepository = $containerRepository;
    }

    public function registerDelivery(array $data)
    {

        $container = $this->containerRepository->findById($data['container_id']);

        $this->deliveryRepository->create([
            'green_point_id' => $data['green_point_id'],
            'container_id' => $data['container_id'],
            'quantity_kg' => $data['quantity_kg'],
            'user_id' => $data['user_id'] ?? null,
            'citizen_code' => $data['citizen_code'] ?? null,
            'delivered_at' => now()
        ]);

        $newKg = $container->current_kg + $data['quantity_kg'];

        $this->containerRepository->update($container->id, [
            'current_kg' => $newKg
        ]);
    }

}
