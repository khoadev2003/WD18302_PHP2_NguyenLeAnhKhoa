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

    public function checkIdExists(int $userId)
    {
        return $this->userModel->getOne($userId);
    }

    /**
     * @param array $data
     * @return false|mixed|string
     */
    public function createUser(array $data) {
        return $this->userModel->create($data);

    }

    /**
     * @param string $username
     * @param int $currentId
     * @return array|false
     */
    public function isUsernameUniqueExcludeCurrent(string $username, int $currentId)
    {
        return $this->userModel->selectWithWhere('username', "username = '$username' AND id != '$currentId'");
    }

    public function isEmailUniqueExcludeCurrent(string $email, int $currentId)
    {
        return $this->userModel->selectWithWhere('email', "email = '$email' AND id != '$currentId'");
    }

    public function isPhoneUniqueExcludeCurrent(string $phone, int $currentId)
    {
        return $this->userModel->selectWithWhere('phone', "phone = '$phone' AND id != '$currentId'");
    }

    public function isUsernameUnique(string $username)
    {
        return $this->userModel->selectWithWhere('username', "username = '$username'");
    }

    public function isEmailUnique(string $email)
    {
        return $this->userModel->selectWithWhere('email', "email = '$email'");
    }

    public function getUserById(int $id)
    {
        return $this->userModel->getOne($id);
    }

    public function updateUser(int $id, array $data): bool
    {
        return $this->userModel->update($id, $data);
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