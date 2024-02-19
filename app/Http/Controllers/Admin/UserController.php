<?php

namespace App\Http\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Validator\Validator;

class UserController extends Controller
{
    public $data;
    public $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function listUser() {
        Session::set('title_page', 'Danh sách tài khoản');

        $this->data['main']= 'admin/users/list';

        $this->data['content'] = [
            'title' => 'Danh sách tài khoản',
            'list_user' => $this->userRepository->getAllUser(),
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function addUser() {
        Session::set('title_page', 'Thêm tài khoản');

        $this->data['main']= 'admin/users/add';

        $this->data['content'] = [
            'title' => 'Thêm tài khoản',
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleAddUser() {
        $request = new Request();

        $data = [
            'fullname' => trim($request->input('fullname')),
            'username' => trim($request->input('username')),
            'email' => trim($request->input('email')),
            'phone' => trim($request->input('phone')),
            'password' => trim($request->input('password')),
            'confirm' => trim($request->input('confirm')),
//            'image' => $_FILES['image'],
        ];

        $rules = UserRequest::rules();
        $messages = UserRequest::messages();

        $validator = new Validator($data, $rules, $messages);

        if ($validator->validate()) {

            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['confirm']);

            $result = $this->userRepository->createUser($data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Thêm tài khoản thành công');
                $this->redirect('admin/tai-khoan/them');

            }else {
                Session::set('not-success', 'Thêm tài khoản thất bại');
                $this->redirect('admin/tai-khoan/them');
            }


        } else {
            $errors = $validator->errors();
            foreach ($errors as $field => $errorMessages) {
                foreach ($errorMessages as $errorMessage) {
                    Session::set('err_'.$field, $errorMessage);

                }
            }

            // Lưu lại value của input sau khi thông báo lỗi
            foreach ($data as $field => $msg) {

                with(
                    $field,
                    $request->input($field)
                );
            }


            Session::set('not-success', 'Thêm tài khoản không thành công vui lòng kiểm tra lại !');
            $this->redirect('admin/tai-khoan/them');
        }

    }

    public function handleDeleteUser()
    {
        $request = new Request();
        $id_user = $request->get('id');

        $result = $this->userRepository->removeUser($id_user);
        if($result) {
            Session::set('success', 'Xóa tài khoản thành công!');
            $this->redirect('admin/tai-khoan');
        }else {
            Session::set('not-success', 'Xóa tài khoản thất bại!');
            $this->redirect('admin/tai-khoan');
        }
    }
}