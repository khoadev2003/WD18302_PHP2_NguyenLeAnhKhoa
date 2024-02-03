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
}