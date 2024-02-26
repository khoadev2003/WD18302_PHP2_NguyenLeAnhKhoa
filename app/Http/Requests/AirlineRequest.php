<?php

namespace App\Http\Requests;

class AirlineRequest
{
    public static function rules(): array
    {

        return [
            'name' => 'required|max:255',
            'logo_path' => 'file_format:jpg,png',
        ];

    }

    public static function messages(): array
    {

        return [
            'name' => [
                'required' => 'Tên hãng không để trống!',
                'max' => 'Tên hãng tối đa 255 ký tự!',
            ],
            'logo_path' => [
                'required' => 'Logo không để trống!',
                'file_format' => 'Vui lòng chọn file có định dạng (PNG, JPG)',
            ],
        ];

    }

    public static function rulesUpdate(): array
    {

        return [
            'name' => 'required|max:255',
        ];

    }

    public static function messagesUpdate(): array
    {

        return [
            'name' => [
                'required' => 'Tên hãng không để trống!',
                'max' => 'Tên hãng tối đa 255 ký tự!',
            ],

        ];

    }
}