<?php
namespace App\Core;

// BaseModel controller
class Controller
{
    public function model($model) {
        $file = _DIR_ROOT. '/app/Models/' .$model. '.php';
        if (file_exists($file)) {
            require_once $file;
            if(class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }

        return false;
    }

    public function view($view, $data=[]) {
        // Đổi các key của mảng thành biến
        extract($data);

        $file = _DIR_ROOT. '/app/Views/' .$view. '.php';
        if (file_exists($file)) {

            require_once $file;
        }
    }

    public function render($view, $data=[]) {
        // Đổi các key của mảng thành biến
        extract($data);

        $file = _DIR_ROOT. '/app/Views/' .$view. '.php';
        if (file_exists($file)) {

            require_once $file;
        }
    }

    public function redirect($uri ='') {
        if(preg_match('~^(http|https)~is', $uri)) {
            $url = $uri;
        }else {
            $url = _WEB_ROOT.'/'. $uri;
        }

        header("Location: ".$url);
        exit;
    }




    // Method cho việc hiển thị view trực tiếp
    public function show($view)
    {
        $this->render($view);
    }
}