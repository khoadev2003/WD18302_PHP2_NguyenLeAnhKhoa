<?php

namespace App\Models;

use App\Models\BaseModel;

class Flight extends BaseModel
{
    protected $table = 'flights';
    public function getAllFilght()
    {

        $query = "SELECT flights.*, airlines.name AS airline_name, airlines.logo_path as logo_airline , departure_airports.name AS departure_airport_name, arrival_airports.name AS arrival_airport_name 
                    FROM flights 
                        JOIN airlines ON flights.airline_id = airlines.id 
                        JOIN airports AS departure_airports ON flights.departure_airport_id = departure_airports.id 
                        JOIN airports AS arrival_airports ON flights.arrival_airport_id = arrival_airports.id
                  ";

        return $this->db->select($query);

    }

    public function updateFilght(int $id, array $data)
    {
        return $this->update($id, $data);
    }
}