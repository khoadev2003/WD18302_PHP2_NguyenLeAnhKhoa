<?php

namespace App\Models;

use App\Models\BaseModel;

class UserModel extends BaseModel{


    public function getUsers() {
        $sql = "SELECT * FROM users";

        return $this->select($sql);
    }

    public function getEmailUsers() {
        $sql = "SELECT email, full_name FROM users";

        return $this->select($sql);
    }
}