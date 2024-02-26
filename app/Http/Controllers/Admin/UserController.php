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
        $count_err=0;

        $data = [
            'fullname' => trim($request->input('fullname')),
            'username' => trim($request->input('username')),
            'email' => trim($request->input('email')),
            'phone' => trim($request->input('phone')),
            'password' => trim($request->input('password')),
            'confirm' => trim($request->input('confirm')),
//            'image' => $_FILES['image'],
        ];

        $checkEmailUnique = $this->userRepository->isEmailUnique($data['email']);
        if(count($checkEmailUnique) > 0) {
            Session::set('err_email', 'Địa chỉ email đã tồn tại');
            $count_err++;
        }

        $checkPhoneUnique = $this->userRepository->isPhoneUnique($data['phone']);
        if(count($checkPhoneUnique) > 0) {
            Session::set('err_phone', 'Số điện thoại đã tồn tại');
            $count_err++;
        }

        $checkPhoneUnique = $this->userRepository->isUsernameUnique($data['username']);
        if(count($checkPhoneUnique) > 0) {
            Session::set('err_username', 'Tên đăng nhập đã tồn tại');
            $count_err++;
        }


        $rules = UserRequest::rules();
        $messages = UserRequest::messages();

        $validator = new Validator($data, $rules, $messages);

        if ($validator->validate() && $count_err == 0) {

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

    public function updateUser()
    {
        Session::set('title_page', 'Cập nhật tài khoản');
        $request = new Request();
        $userId = $request->get('id');

        $checkIdExists = $this->userRepository->checkIdExists($userId);
        if(count($checkIdExists) < 1) {
            $this->redirect('404');
        }

        $this->data['main']= 'admin/users/update';

        $this->data['content'] = [
            'title' => 'Cập nhật tài khoản',
            'user_details' => $this->userRepository->getUserById($userId),
        ];

        $this->render('layouts/admin_layout', $this->data);
    }

    public function handleUpdateUser()
    {
        $request = new Request();
        $userId = $request->get('id');
        $count_err = 0;

        $data = [
            'fullname' => trim($request->input('fullname')),
            'username' => trim($request->input('username')),
            'email' => trim($request->input('email')),
            'phone' => trim($request->input('phone')),
        ];


        $checkEmailUnique = $this->userRepository->isEmailUniqueExcludeCurrent($data['email'], $userId);
        if(count($checkEmailUnique) > 0) {
            Session::set('err_email', 'Địa chỉ email đã tồn tại');
            $count_err++;
        }

        $checkPhoneUnique = $this->userRepository->isPhoneUniqueExcludeCurrent($data['phone'], $userId);
        if(count($checkPhoneUnique) > 0) {
            Session::set('err_phone', 'Số điện thoại đã tồn tại');
            $count_err++;
        }


        $rules = UserRequest::ruleUpdate();
        $messages = UserRequest::messageUpdate();

        $validator = new Validator($data, $rules, $messages);

        if ($validator->validate() && $count_err == 0) {


            $result = $this->userRepository->updateUser($userId, $data);

            if($result !== false && $result !== null) {
                Session::set('success', 'Cập nhật tài khoản thành công');
                $this->redirect('admin/tai-khoan/cap-nhat/'.$userId);

            }else {
                Session::set('not-success', 'Cập nhật tài khoản thất bại');
                $this->redirect('admin/tai-khoan/cap-nhat/'.$userId);
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


            Session::set('not-success', 'Cập nhật không thành công vui lòng kiểm tra lại !');
            $this->redirect('admin/tai-khoan/cap-nhat/'.$userId);
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