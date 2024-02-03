<?php

namespace App\Repositories\Interfaces;

interface AirlineRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAllAirline();

    /**
     * @param int $id
     * @return mixed
     */
    public function getAirlineById(int $id);
}