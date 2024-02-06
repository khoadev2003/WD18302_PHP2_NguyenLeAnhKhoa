<?php

namespace App\Validator;

use App\Core\Request;
use App\Validator\Validator;

class UserValidator
{
    public function test()
    {
        $rules = [
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users,email,' . $currentUserEmail, // $currentUserEmail là giá trị ngoại trừ
            // Các quy tắc khác...
        ];
    }


    public static function rules(): array
    {

        return [
            'fullname' => 'required|min:3|max:255|alphabet',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|email',
            'phone' => 'required|phone|unique:users',
            'password' => 'required|min:5|max:255',
            'confirm' => 'required|same:password',
        ];

    }

    public static function messages(): array
    {
        return [
            'fullname' => [
                'required' => 'Họ tên không để trống',
                'min' => 'Họ tên ít nhất 6 ký tự',
                'max' => 'Họ tên tối đa 255 ký tự',
                'alphabet' =>'Họ tên chỉ được nhập kiểu chữ'
            ],
            'username' => [
                'unique' => 'Tài khoản đã tồn tại',
                'required' => 'Tài khoản không để trống',
                'min' => 'Tên dăng nhập ít nhất 3 ký tự',
                'max' => 'Tên dăng nhập tối đa 20 ký tự'
            ],
            'email' => [
                'required' => 'Email không để trống.',
                'email' => 'Email không hợp lệ'
            ],
            'phone' => [
                'required' => 'Số điện thoại để trống',
                'phone' => 'Số điện thoại không hợp lệ',
                'unique' => 'Số điện thoại đã tồn tại',

            ],
            'password' => [
                'max' => 'Tối thiểu 255',
                'min' => 'Mật khẩu 5 ký tự trở lên',
                'required' => 'Mật khẩu không để trống.',
            ],
            'confirm' => [
                'required' => 'Xác nhận mật khẩu không để trống.',
                'same' => 'Xác nhận mật khẩu không trùng khớp',
            ]
        ];
    }
}