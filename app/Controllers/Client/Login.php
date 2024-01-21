<?php
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class Login extends Controller
{
    public $data;
    public function index() {

    }

    public function get_user() {
        $request = new Request();
        $data = $request->getFields();

        echo '<pre>';
        print_r($data);
        echo '<pre>';


        $this->render('clients/account/register');
    }

    public function post_user() {
        $request = new Request();

        if($request->isPost()) {

            //Set rules
            $request->rules([
                'fullname' => 'required|min:5|max:255',
                'email' => 'required|email|min:6|unique:users:email',
                'password' => 'required|min:5',
                'confirm_password' => 'required|min:3|match:password'
            ]);

            //Set message
            $request->message([
                'fullname.required' => 'Họ tên không được để trống',
                'fullname.min' => 'Họ tên phải lớn hơn 5 ký tự',
                'fullname.max' => 'Họ tên tối đa 255 ký tự',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không hợp lệ',
                'email.min' => 'Email phải lớn hơn 5 ký tự',
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu phải lớn hơn 5 ký tự',
                'confirm_password.required' => 'Nhâp lại mật khẩu không được để trống',
                'confirm_password.min' => 'Nhâp lại mật khẩu phải lớn hơn 5 ký tự',
                'confirm_password.match' => 'Nhâp lại mật khẩu không trùng khớp',

            ]);


            $validate = $request->validate();

            if(!$validate) {
                $this->data['errors'] = $request->errors();
                $this->data['msg'] = 'Có lỗi xảy ra';
                $this->data['old'] = $request->getFields();
            }


            if(!empty($this->data)) {
                $this->render('clients/account/register', $this->data);
            }else {
                $this->render('clients/account/register');
            }

        }
        else {
            $response = new Response();
            $response->redirect('dang-ky');
        }



    }
}