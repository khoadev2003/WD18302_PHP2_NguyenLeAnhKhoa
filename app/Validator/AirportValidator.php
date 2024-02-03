<?php

namespace App\Validator;

use App\Repositories\AirportRepository;

class AirportValidator
{
//    public $airportRepository;
    public function __construct()
    {
        $this->airportRepository = new AirportRepository();
    }

    public function checkNameExists($name_airport): bool
    {
        $nameExists = $this->airportRepository->getAirportByName('name','name', $name_airport);

        if(count($nameExists) > 0) {
            return true;
        }

        return false;
    }
}