<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function login($email, $password);
    public static function logout();

    public static function checkLogin();

    public function getPasswordHash($username);

}