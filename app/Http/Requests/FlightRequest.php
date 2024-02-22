<?php

namespace App\Http\Requests;

class FlightRequest
{
    public static function rules(): array
    {

        return [
            'name' => "required|max:255",
            'airline_id' => 'required',
            'seat' => 'required|greater_than_zero|integer',
            'price' => 'required|greater_than_zero|integer',
            'departure_airport_id' => 'required',
            'arrival_airport_id' => 'required|not_same:departure_airport_id',
            'departure_datetime' => 'required|future_datetime',
            'arrival_datetime' => 'required|future_datetime',
        ];
    }


    public static function messages(): array
    {

        return [
            'name' => [
                'required' => 'Vui lòng nhập số hiệu chuyến bay',
                'max' => 'Tên chuyến bay tối đa 255 ký tự',
            ],
            'airline_id' => [
                'required' => 'Vui lòng chọn hãng hàng không',
            ],
            'seat' => [
                'required' => 'Vui lòng nhập số ghế',
                'greater_than_zero' => 'Số ghế phải lớn hơn 0',
                'integer' => 'Số lượng phải là một số nguyên',
            ],
            'price' => [
                'required' => 'Vui lòng nhập giá tiền',
                'greater_than_zero' => 'Giá tiền phải lớn hơn 0',
                'integer' => 'Giá tiền phải là một số nguyên',
            ],
            'departure_airport_id' => [
                'required' => 'Vui lòng chọn địa điểm khởi hành',
            ],
            'arrival_airport_id' => [
                'required' => 'Vui lòng chọn địa điểm đến',
                'not_same' => 'Điểm đến không được trùng điểm khởi hành haha',
            ],
            'departure_datetime' => [
                'required' => 'Vui lòng nhập ngày giờ khởi hành',
                'future_datetime' => 'Không được nhập ngày giờ quá khứ',
            ],
            'arrival_datetime' => [
                'required' => 'Vui lòng nhập ngày giờ đến',
                'future_datetime' => 'Không được nhập ngày giờ quá khứ',
            ],
        ];

    }
}