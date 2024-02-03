<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\User;
use App\Repositories\UserRepository;

class UserController extends Controller{
    public $data = [];
    public $user;
    public $userRepository;


    public function __construct()
    {
        $this->user = new User();
        $this->userRepository = new UserRepository();
    }

    public function index() {

        $this->render('admin/users/login', $this->data);
    }

    public function handleLogin()
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

        if(!empty($email) && !empty($password)) {
            if($this->userRepository->login($email, $password)) {

                Session::set('username', $email);
                $this->redirect('admin');
            }else {
                Session::set('err_password', 'Tài khoản hoặc mật khẩu không chính xác');
                $count_err++;
            }
        }


        if($count_err > 0) {
            with('email', $email);
            with('password', $password);

            $this->redirect('admin/dang-nhap');
        }

    }

    public function logout() {
        $this->userRepository->logout();

        $this->redirect('admin/dang-nhap');
    }

    public function resetPassword() {
        
        $this->view('admin/users/reset-password', $this->data);
    }



}