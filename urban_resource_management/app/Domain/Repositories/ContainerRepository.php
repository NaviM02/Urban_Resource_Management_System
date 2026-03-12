<?php

namespace App\Domain\Repositories;

interface ContainerRepository
{
    public function findAll();
    public function findById($id);
    public function findByGreenPoint($greenPointId);
    public function create(array $data);
    public function update($id, array $data);

}
