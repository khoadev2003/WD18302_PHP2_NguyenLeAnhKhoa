<?php
namespace App\Core;

// Base controller
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

    public function render($view, $data=[]) {
        // Đổi các key của mảng thành biến
        extract($data);

        $file = _DIR_ROOT. '/app/views/' .$view. '.php';
        if (file_exists($file)) {

            require_once $file;
        }
    }

    public function render2($view, $data = []) {
        // Đổi các key của mảng thành biến
        extract($data);
    
        $file = _DIR_ROOT . '/app/views/' . $view . '.php';
        if (file_exists($file)) {
            ob_start();
            require_once $file;
            $output = ob_get_clean();
    
            // Support for Blade-like syntax
            $output = preg_replace('/{{\s*(\$[\w.]+)\s*}}/', '<?= $1 ?>', $output);
    
            return $output;
        } else {
            echo "<h2>Error: View not found</h2>";
        }
    }



    // Method cho việc hiển thị view trực tiếp
    public function show($view)
    {
        $this->render($view);
    }
}