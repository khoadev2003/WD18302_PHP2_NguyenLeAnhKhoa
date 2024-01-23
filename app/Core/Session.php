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

    /**
     * Thiết lập giá trị cho session dựa trên key.
     * 
     * @param string $key - Khóa để lưu giữ giá trị trong session.
     * @param mixed $value - Giá trị cần lưu vào session.
    */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Lấy giá trị từ session theo key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    /**
     * Kiểm tra xem một key có tồn tại trong session hay không.
     *
     * @param string $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }


    /**
     * Xóa giá trị từ session dựa trên key.
     *
     * @param string $key - Khóa của giá trị cần xóa từ session.
     */
    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    

     /**
     * Lấy giá trị từ session theo key và xóa nó ngay sau đó.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function pull($key, $default = null)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }

        return $default;
    }


}