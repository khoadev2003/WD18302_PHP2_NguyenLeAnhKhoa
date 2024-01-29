<?php

namespace App\Models;

use App\Models\BaseModel;
class Airport extends BaseModel
{
    protected $table = 'airports';

    public function getAllAirport() {
        return $this->getAll();
    }

    public function getDetailAirport(int $id) {
        return $this->getOne($id);
    }

    public function updateAirport(int $id, array $data)
    {
        return $this->update($id, $data);
    }

    public function deleteAirport($id)
    {

    }
}