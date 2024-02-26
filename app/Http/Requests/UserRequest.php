<?php

namespace App\Http\Requests;

class UserRequest
{

    public static function rules(): array
    {

        return [
            'fullname' => 'required|min:3|max:255|alphabet|not_same:username',
            'username' => 'required|min:3|max:20|username',
            'email' => 'required|email',
            'phone' => 'required|phone|max:10',
            'password' => 'required|min:5|max:255|strong_password',
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
                'alphabet' =>'Họ tên chỉ được nhập kiểu chữ',
                'not_same' => 'Họ tên không được trùng tên đăng nhập'
            ],
            'username' => [
                'required' => 'Tài khoản không để trống',
                'min' => 'Tên dăng nhập ít nhất 3 ký tự',
                'max' => 'Tên dăng nhập tối đa 20 ký tự',
                'username' => 'Tên đăng nhập chỉ nhập ( a - z và 0- 9 )'
            ],
            'email' => [
                'required' => 'Email không để trống.',
                'email' => 'Email không hợp lệ',
            ],
            'phone' => [
                'required' => 'Số điện thoại để trống',
                'phone' => 'Số điện thoại không hợp lệ',
                'max' => 'Số điện thoại tối đa 10 số.',

            ],
            'password' => [
                'max' => 'Tối thiểu 255',
                'min' => 'Mật khẩu 5 ký tự trở lên',
                'required' => 'Mật khẩu không để trống.',
                'strong_password' => 'Mật khẩu phải chứa (trên 7 ký tự, 1 chữ hoa, 1 số)',
            ],
            'confirm' => [
                'required' => 'Xác nhận mật khẩu không để trống.',
                'same' => 'Xác nhận mật khẩu không trùng khớp',
            ],
//            'image' => [
//                'file_format' => 'Định dạng ảnh không hợp lệ (PNG, JPG)',
//            ]
        ];
    }

    public static function ruleUpdate(): array
    {

        return [
            'fullname' => 'required|min:3|max:255|alphabet',
            'email' => 'required|email',
            'phone' => 'required|phone|max:10',
        ];

    }

    public static function messageUpdate(): array
    {
        return [
            'fullname' => [
                'required' => 'Họ tên không để trống',
                'min' => 'Họ tên ít nhất 6 ký tự',
                'max' => 'Họ tên tối đa 255 ký tự',
                'alphabet' =>'Họ tên chỉ được nhập kiểu chữ',
                'not_same' => 'Họ tên không được trùng tên đăng nhập'
            ],
            'email' => [
                'required' => 'Email không để trống.',
                'email' => 'Email không đúng định dạng.',
            ],
            'phone' => [
                'required' => 'Số điện thoại để trống',
                'phone' => 'Số điện thoại không hợp lệ',
                'max' => 'Số điện thoại tối đa 10 số.',

            ],
        ];
    }
}