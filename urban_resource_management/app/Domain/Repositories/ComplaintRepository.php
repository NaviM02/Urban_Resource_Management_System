<?php

namespace App\Domain\Repositories;

interface ComplaintRepository
{
    public function findAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);

}
