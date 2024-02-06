<?php

namespace App\Repositories;

use App\Core\Request;
use App\Core\Session;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login($email, $password): bool {
        $hashedPassword = $this->getPasswordHash($email);

        if ($hashedPassword !== null && password_verify($password, $hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }

    public static function logout() {
        Session::remove('username');

    }

    public static function checkLogin() {
        $request = new Request();
        if(!Session::has('username')) {
            $request->redirect('admin/dang-nhap');
        }
    }

    public function getPasswordHash($username) {

        $result = $this->userModel->getRawPassword($username);

        if (!empty($result)) {
            return $result[0]['password'];
        }

        return null;
    }


    public function getAllUser()
    {
        return $this->userModel->getAll();
    }

    /**
     * @param array $data
     * @return false|mixed|string
     */
    public function createUser(array $data) {
        return $this->userModel->create($data);

    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeUser(int $id): bool
    {
        return $this->userModel->remove($id);
    }

}