<?php

namespace App\Http\Requests;

class AirportRequest
{
    public static function rules(): array
    {

        return [
            'name' => "required|max:255",
            'location' => 'required|max:255',
        ];
    }


    public static function messages(): array
    {

        return [
            'name' => [
                'required' => 'Tên sân bay không để trống.',
                'max' => 'Tên sân bay tối đa 255 ký tự.',
            ],
            'location' => [
                'required' => 'Vị trí không để trống.',
                'max' => 'Vị trí tối đa 255 ký tự.',
            ],
        ];

    }
}