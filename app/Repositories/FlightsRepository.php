<?php

namespace App\Repositories;

use App\Models\Flight;

class FlightsRepository
{
    protected $flightModel;

    public function __construct() {
        $this->flightModel = new Flight();
    }

    public function getFlightsByAirlineId(int $airlineId) {
        return $this->flightModel->selectWithWhere('*', "airline_id = $airlineId");
    }

    public function getFlightsByDepartureId (int $departureId) {
        return $this->flightModel->selectWithWhere('*', "departure_airport_id  = $departureId");
    }

    public function getFlightsByArrivalId (int $arrivalId) {
        return $this->flightModel->selectWithWhere('*', "arrival_airport_id  = $arrivalId");
    }

}