<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;

class AuthController extends Controller{
    public $data = [];

    public function index() {

        $this->render('admin/users/login', $this->data);
    }

    public function checkLogin()
    {
        $request = new Request();
        $count_err = 0;

        $email = $request->input('email');
        $password = $request->input('password');
        $email = trim($email);
        $password = trim($password);

        if(empty($email)) {
            Session::set('err_email', 'Không được để trống');
            $count_err++;
        }

        if(empty($password)) {
            Session::set('err_password', 'Không được để trống');
            $count_err++;
        }

        if($count_err > 0) {
            with('email', $email);
            with('password', $password);
            $request->redirect('admin/dang-nhap');
        }else {
            //Xử lý đăng nhập -> chuyển hướng
        }

    }

    public function resetPassword() {
        
        $this->render('admin/users/reset-password', $this->data);
    }



}