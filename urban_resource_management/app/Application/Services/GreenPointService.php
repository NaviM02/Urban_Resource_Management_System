<?php

namespace App\Application\Services;

use App\Domain\Enums\StatusEnum;
use App\Domain\Exceptions\EntityAlreadyExistsException;
use App\Domain\Exceptions\EntityNotFoundException;
use App\Domain\Repositories\GreenPointRepository;
use App\Domain\Repositories\ContainerRepository;
use App\Domain\Repositories\MaterialDeliveryRepository;
use App\Domain\Repositories\MaterialTypeRepository;

class GreenPointService
{

    private GreenPointRepository $greenPointRepository;
    private ContainerRepository $containerRepository;
    private MaterialDeliveryRepository $deliveryRepository;
    private MaterialTypeRepository $materialTypeRepository;

    public function __construct(
        GreenPointRepository $greenPointRepository,
        ContainerRepository $containerRepository,
        MaterialDeliveryRepository $deliveryRepository,
        MaterialTypeRepository $materialTypeRepository
    ){
        $this->greenPointRepository = $greenPointRepository;
        $this->containerRepository = $containerRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->materialTypeRepository = $materialTypeRepository;
    }

    public function findAll()
    {
        return $this->greenPointRepository->findAll();
    }

    public function findById($id)
    {
        $greenPoint = $this->greenPointRepository->findById($id);

        if (!$greenPoint) {
            throw new EntityNotFoundException('Green point not found');
        }

        return $greenPoint;
    }

    public function create(array $data)
    {
        if ($this->greenPointRepository->existsByName($data['name'])) {
            throw new EntityAlreadyExistsException('Green point name already exists');
        }

        $greenPoint = $this->greenPointRepository->create($data);

        // create dynamic containers
        $materials = $this->materialTypeRepository->findAll();

        foreach ($materials as $material) {

            $this->containerRepository->create([
                'green_point_id' => $greenPoint->id,
                'material_type_id' => $material->id,
                'capacity_kg' => 500,
                'current_kg' => 0
            ]);

        }

        return $greenPoint;
    }

    public function update($id, array $data)
    {
        if (isset($data['name']) &&
            $this->greenPointRepository->existsByName($data['name'], $id)) {

            throw new EntityAlreadyExistsException('Green point name already exists');
        }

        return $this->greenPointRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->greenPointRepository->update($id, [
            'status_id' => StatusEnum::DELETED
        ]);
    }

    public function registerDelivery(array $data)
    {

        $container = $this->containerRepository->findById($data['container_id']);

        if (!$container) {
            throw new EntityNotFoundException('Container not found');
        }

        $quantity = $data['quantity_kg'];

        $newAmount = $container->current_kg + $quantity;

        if ($newAmount > $container->capacity_kg) {
            throw new \InvalidArgumentException('Container capacity exceeded');
        }

        // guardar entrega
        $this->deliveryRepository->create([
            'green_point_id' => $data['green_point_id'],
            'container_id' => $data['container_id'],
            'quantity_kg' => $quantity,
            'user_id' => $data['user_id'] ?? null,
            'citizen_code' => $data['citizen_code'] ?? null,
            'delivered_at' => now()
        ]);

        // actualizar llenado
        $this->containerRepository->update($container->id, [
            'current_kg' => $newAmount
        ]);

    }

}
