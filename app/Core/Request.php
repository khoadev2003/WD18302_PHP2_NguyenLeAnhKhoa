<?php
namespace App\Core;

class Request
{
    private $__rules = [], $__messages = [], $errors;
//    public $errors = [];

    /*
     *  1. Method
     *  2. Body
     * */

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost() {
        if($this->getMethod() == 'post') {
            return true;
        }

        return false;
    }

    public function isGet() {
        if($this->getMethod() == 'get') {
            return true;
        }

        return false;
    }

    public function getFields() {

        $dataFields = [];
        //Phương thức GET
        if($this->isGet()) {
           if(!empty($_GET)) {
               foreach ($_GET as $key=>$value) {
                   if(is_array($value)) {
                       $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                   }else{
                       $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                   }

               }
           }

        }

        //Phương thức POST
        if($this->isPost()) {
            if(!empty($_POST)) {
                foreach ($_POST as $key=>$value) {
                    if(is_array($value)) {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    }else{
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }

                }
            }

        }

        return $dataFields;
    }

    //Set rules
    public function rules($rules= []) {
        $this->__rules = $rules;
//        echo '<pre>';
//        print_r($this->__rules);
//        echo '<pre>';
    }

    //Set message
    public function message($message= []) {
        $this->__messages = $message;

    }

    //Run validate
    public function validate() {
        $this->__rules = array_filter($this->__rules);

        $checkValidate = true;

        if(!empty($this->__rules)) {
            // Lấy giá trị các trường name trong input
            $dataField = $this->getFields();

            foreach ($this->__rules as $fieldName =>$ruleItem) {
                // Tách giá trị mảng  '|' VD: required|min:5|max:255 ==> [0]required, [1]min:5, [2]max:255
                $ruleItemArr = explode('|', $ruleItem);

                foreach ($ruleItemArr as $rules) {

                    $ruleName = null;
                    $ruleValue = null;
                    // Tách giá trị mảng ':' VD: min:5 ==> [0]=> min, [1]=> 5
                    $rulesArr = explode(':', $rules);

                    // Lấy giá trị đầu tiên <=> $rulesArr[0]
                    $ruleName = reset($rulesArr);

                    if(count($rulesArr) > 1) {
                        $ruleValue = end($rulesArr);
                    }

                    if($ruleName == 'required') {
                        //Check giá trị của từng name trong input
                        if (empty(trim($dataField[$fieldName]))) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if($ruleName == 'min') {
                        //Check giá trị của từng name trong input
                        if(strlen(trim($dataField[$fieldName])) < $ruleValue) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if($ruleName == 'max') {
                        //Check giá trị của từng name trong input
                        if(strlen(trim($dataField[$fieldName])) > $ruleValue) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    if($ruleName == 'email') {
                        //Check giá trị của từng name trong input
                        if(!filter_var($dataField[$fieldName], FILTER_VALIDATE_EMAIL)) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }

                    }

                    if($ruleName == 'match') {
                        //Check giá trị của từng name trong input
                        if(trim($dataField[$fieldName]) != trim($dataField[$ruleValue])) {
                            $this->setErrors($fieldName, $ruleName);
                            $checkValidate = false;
                        }
                    }

                    // Kiểm tra các table database
                    if($ruleName == 'unique') {
                        $tableName = null;
                        $fieldCheck = null;
                        if(!empty($rulesArr[1])) {
                            $tableName = $rulesArr[1];
                        }

                        if(!empty($rulesArr[2])) {
                            $fieldCheck = $rulesArr[2];
                        }

                        //Kiểm tra tên table và các trường
                        if(!empty($tableName) && !empty($fieldCheck)) {

                        }

                        echo $tableName .'<br>';
                        echo $fieldCheck .'<br>';


                    }

                    echo '<pre>';
                    print_r($rulesArr);
                    echo '<pre>';
                }
            }
        }

        return $checkValidate;
    }

    //Error
    public function errors($fieldName= '') {
        if(!empty($this->errors)) {
            if(empty($fieldName)) {
                $errorsArr = [];
                foreach ($this->errors as $key=>$error) {
                    $errorsArr[$key] = reset($error);
                }

                return $errorsArr;

            }
            return reset($this->errors[$fieldName]);
        }

        return false;
    }

    public function setErrors($fieldName, $ruleName) {
        $this->errors[$fieldName][$ruleName] = $this->__messages[$fieldName.'.'.$ruleName];
    }



    // Custom
    public static function input($key, $default = null)
    {
        return isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
    }

    public static function get($key, $default = null)
    {
        return isset($_GET[$key]) ? $_GET[$key] : $default;
    }

    public static function post($key, $default = null)
    {
        return isset($_POST[$key]) ? $_POST[$key] : $default;
    }

    public static function has($key)
    {
        return isset($_REQUEST[$key]);
    }

    public static function all()
    {
        return $_REQUEST;
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }


}