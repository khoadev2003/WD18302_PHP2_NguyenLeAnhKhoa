<?php

namespace App\Repositories;

use App\Models\Flight;

class FlightsRepository
{
    protected $flightModel;

    public function __construct() {
        $this->flightModel = new Flight();
    }

    public function checkIdExists(int $flightId)
    {
        return $this->flightModel->getOne($flightId);
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

    public function getFlightById(int $id)
    {
        return $this->flightModel->getOne($id);
    }

    public function createFlight(array $data)
    {
        return $this->flightModel->create($data);
    }

    public function updateFlight(int $id, array $data): bool
    {
        return $this->flightModel->update($id, $data);
    }

    public function removeFlight(int $id): bool
    {
        return $this->flightModel->remove($id);
    }

}