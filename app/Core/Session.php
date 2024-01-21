<?php
namespace App\Core;

class Session
{

    public static function old($key, $default = '')
    {
        $value = isset($_SESSION['old_input'][$key]) ? $_SESSION['old_input'][$key] : null;

        if ($value !== null) {
            unset($_SESSION['old_input'][$key]); // Xóa giá trị sau khi sử dụng
            return $value;
        }

        $value = isset($_SESSION['view_data'][$key]) ? $_SESSION['view_data'][$key] : $default;
        unset($_SESSION['view_data'][$key]); // Xóa dữ liệu sau khi sử dụng

        return $value;
    }



    public static function with($key, $value)
    {
        $_SESSION['view_data'][$key] = $value;
    }


}