<?php

namespace App\Repositories;

use App\Models\Airline;
use App\Repositories\Interfaces\AirlineRepositoryInterface;

class AirlineRepository implements AirlineRepositoryInterface
{
    protected $airlineModel;

    public function __construct() {
        $this->airlineModel = new Airline();
    }

    public function checkIdExists(int $airlineId)
    {
        return $this->airlineModel->getOne($airlineId);
    }

    public function isNameUniqueExcludeCurrent(string $name, int $currentId)
    {
        return $this->airlineModel->selectWithWhere('name', "name = '$name' AND id != '$currentId'");
    }

    public function isNameUnique(string $name)
    {
        return $this->airlineModel->selectWithWhere('name', "name = '$name'");
    }

    public function getAllAirline()
    {
        return $this->airlineModel->getAll();
    }

    public function getAirlineById(int $id)
    {
        return $this->airlineModel->getOne($id);
    }

    public function getAirportByName($columns, $whereField, $likeValue)
    {
        return $this->airlineModel->selectWithLike($columns, $whereField, $likeValue);
    }

    public function createAirline(array $data) {
        return $this->airlineModel->create($data);

    }

    public function updateAirline(int $id, array $data): bool
    {
        return $this->airlineModel->update($id, $data);
    }

    public function removeAirline(int $id): bool
    {
        return $this->airlineModel->remove($id);
    }
}