<?php

namespace App\Http\Requests;

class AirportRequest
{
    public static function rules(): array
    {

        return [
            'name' => "required|max:255|unique:airports",
            'location' => 'required|max:255',
        ];
    }


    public static function messages(): array
    {

        return [
            'name' => [
                'required' => 'Tên sân bay không để trống.',
                'max' => 'Tên sân bay tối đa 255 ký tự.',
                'unique' => 'Tên sân bay đã tồn tại.',
            ],
            'location' => [
                'required' => 'Vị trí không để trống.',
                'max' => 'Vị trí tối đa 255 ký tự.',
            ],
        ];

    }
}