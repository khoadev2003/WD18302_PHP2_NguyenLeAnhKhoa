<?php

namespace App\Models;

use App\Models\BaseModel;
class Airline extends BaseModel
{
    protected $table = 'airlines';

    public function getAllAirline()
    {
        return $this->getAll();
    }

    public function getDetailAirline(int $id)
    {
        return $this->getOne($id);
    }
}