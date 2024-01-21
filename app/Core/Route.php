<?php 
namespace App\Core;

class Route{
    public static $routes=[];

    public static function get($path, $callback){
        self::$routes['get'][$path]=$callback;
    }

    public static function post($path, $callback){
        self::$routes['post'][$path]=$callback;

    }

    public static function run(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        // var_dump($method);
        if(empty($_GET['action'])){
            $path = isset($_GET['url']) ? '/'.$_GET['url'] : '/';
        }
        else if(isset($_GET['action']) && empty($_GET['id'])){
            // co the check admin
            $path = isset($_GET['url']) ? '/'.$_GET['url'].'/'.$_GET['action'] : '/';
        }
        else if(isset($_GET['action']) && isset($_GET['id'])){
            // check admin
            $path = isset($_GET['url']) ? '/'.$_GET['url'].'/'.$_GET['action'].'/'.$_GET['id'] : '/';
        }
        else{
            echo '404';
            die();
        }

        // Kiểm tra xem route có tồn tại hay không
        $callback = self::$routes[$method][$path];

        if($callback == false){
    
            echo '404';
            die();
        }

        if(is_object($callback)){
            call_user_func($callback);
        }

        if(is_array($callback)){
            $controller = new $callback[0];
            $action = $callback[1];
            call_user_func([$controller,$action]);
        }

    }

    // Hiển thi lỗi
    public static function loadError($name) {
        require_once 'app/Errors/' .$name. '.php';
    }
}