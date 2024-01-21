<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class AuthController extends Controller{
    public $data = [];

    public function index() {

        $this->render('admin/users/login', $this->data);
    }

    public function resetPassword() {
        
        $this->render('admin/users/reset-password', $this->data);
    }

}