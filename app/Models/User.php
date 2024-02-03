<?php

namespace App\Models;

use App\Core\Session;
use App\Models\BaseModel;
use App\Core\Request;

class User extends BaseModel
{

//    public function login($username, $password) {
//        $hashedPassword = $this->getHashedPassword($username);
//
//        if ($hashedPassword !== null && password_verify($password, $hashedPassword)) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//
//    public static function logout() {
//        Session::remove('username');
//
//    }
//
//    public static function check() {
//        $request = new Request();
//        if(!Session::has('username')) {
//            $request->redirect('admin/dang-nhap');
//        }
//    }
//
//    private function getHashedPassword($username) {
//        $query = "SELECT password FROM users WHERE username = :username";
//        $result = $this->db->select($query, ['username' => $username]);
//
//        if (!empty($result)) {
//            return $result[0]['password'];
//        }
//
//        return null;
//    }

    public function getRawPassword($username)
    {
        $query = "SELECT password FROM users WHERE username = :username";
        return $this->db->select($query, ['username' => $username]);
    }

}