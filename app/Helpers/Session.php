<?php

namespace App\Helpers;

class Session
{
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    public static function has($key)
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function flash($key, $value)
    {
        self::start();
        $_SESSION['_flash'][$key] = $value;
    }

    public static function getFlash($key, $default = null)
    {
        self::start();
        if (isset($_SESSION['_flash'][$key])) {
            $value = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $value;
        }
        return $default;
    }

    public static function all()
    {
        self::start();
        return $_SESSION;
    }

    public static function clear()
    {
        self::start();
        session_unset();
        session_destroy();
    }
}


//Cách sử dụng

// Gán giá trị cho flash session
Session::flash('message', 'This is a flash message.');

// Lấy giá trị của flash session
$message = Session::getFlash('message');

// Biến session sẽ không còn tồn tại sau khi được lấy