<?php

namespace App\Models;

use App\Core\Session;
use App\Models\BaseModel;
use App\Core\Request;

class User extends BaseModel
{
    protected $table = 'users';

    public function getRawPassword($username)
    {
        $query = "SELECT password FROM users WHERE username = :username";
        return $this->db->select($query, ['username' => $username]);
    }

}