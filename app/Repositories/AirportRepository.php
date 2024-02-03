<?php

namespace App\Repositories;

use App\Models\Airport;
use App\Repositories\Interfaces\AirportRepositoryInterface;

class AirportRepository implements AirportRepositoryInterface
{
    protected $airportModel;

    public function __construct() {
        $this->airportModel = new Airport();
    }

    public function getAllAirport()
    {
        return $this->airportModel->getAll();
    }

    public function getAirportById(int $id)
    {
        return $this->airportModel->getOne($id);
    }

    /**
     * @param $columns
     * @param $whereField
     * @param $likeValue
     * @return array|false
     */
    public function getAirportByName($columns, $whereField, $likeValue)
    {
        return $this->airportModel->selectWithLike($columns, $whereField, $likeValue);
    }


    /**
     * @param array $data
     * @return false|mixed|string
     */
    public function createAirport(array $data)
    {
        return $this->airportModel->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateAirport(int $id, array $data): bool
    {
        return $this->airportModel->update($id, $data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeAirport(int $id): bool
    {
        return $this->airportModel->remove($id);
    }
}