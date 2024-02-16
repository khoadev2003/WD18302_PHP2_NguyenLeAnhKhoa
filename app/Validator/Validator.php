<?php

namespace App\Validator;

use App\Core\Database;

class Validator
{
    protected $data;
    protected $rules;
    protected $errors;
    protected $messages;

    public $db;

    public function __construct($data, $rules, $messages = []) {
        $this->data = $data;
        $this->rules = $rules;
        $this->errors = [];
        $this->messages = $messages;
        $this->db = new Database();
    }



    public function validate(): bool {
        foreach ($this->rules as $field => $rule) {
            $rules = explode('|', $rule);

            foreach ($rules as $singleRule) {
                $ruleParts = explode(':', $singleRule);
                $ruleName = $ruleParts[0];
                $param = isset($ruleParts[1]) ? $ruleParts[1] : null;

                // Check if field is required before calling other validation rules
                if ($ruleName === 'required' && !$this->required($field)) {
                    $errorMessage = $this->messages[$field][$ruleName] ?? $this->defaultMessage($ruleName, $field, $param);
                    $this->errors[$field][] = $errorMessage;
                    break; // Dừng xác thực thêm cho trường này nếu nó bắt buộc
                }

                // Validate rule
                $valid = $this->$ruleName($field, $param);

                if (!$valid) {
                    $errorMessage = $this->messages[$field][$ruleName] ?? $this->defaultMessage($ruleName, $field, $param);
                    $this->errors[$field][] = $errorMessage;
                }
            }
        }

        return empty($this->errors);
    }


    public function errors(): array {
        return $this->errors;
    }

    /**
     * @param $field
     * @return bool
     */
    protected function required($field):bool {
        return isset($this->data[$field]) && !empty($this->data[$field]);
    }

    protected function min($field, $value):bool {

        return isset($this->data[$field]) && strlen($this->data[$field]) >= $value;
    }

    protected function max($field, $value):bool {
        return isset($this->data[$field]) && strlen($this->data[$field]) <= $value;
    }

    protected function length($field, $value):bool {
        return isset($this->data[$field]) && strlen($this->data[$field]) == $value;
    }

    protected function numeric($field): bool {
        return isset($this->data[$field]) && is_numeric($this->data[$field]);
    }

    protected function string($field): bool {
        return isset($this->data[$field]) && is_string($this->data[$field]);
    }

    protected function alphabet($field): bool {
        // Biểu thức chính quy để kiểm tra xem trường không chứa ký tự đặc biệt
//        return isset($this->data[$field]) && preg_match('/^[a-zA-Z ]+$/', $this->data[$field]);
        return isset($this->data[$field]) && preg_match('/^[\p{L} ]+$/u', $this->data[$field]);
    }

    protected function username($field): bool {
        // Sử dụng biểu thức chính quy để kiểm tra xem tên đăng nhập chỉ chứa các ký tự a-z và số từ 0-9
        return isset($this->data[$field]) && preg_match('/^[a-z0-9]+$/', $this->data[$field]);
    }

    protected function phone($field):bool {
        return isset($this->data[$field]) && preg_match('/^(03|05|07|08|09)(([0-9]){8})/', $this->data[$field]);
    }

    protected function email($field):bool {
        return isset($this->data[$field]) && filter_var($this->data[$field], FILTER_VALIDATE_EMAIL);
    }

    protected function same($field, $confirmField):bool {
        return isset($this->data[$field]) && isset($this->data[$confirmField]) && $this->data[$field] === $this->data[$confirmField];
    }

    /**
     * Method check 2 giá trị không được trùng nhau
     * @param $field
     * @param $confirmField
     * @return bool
     */
    protected function not_same($field, $confirmField):bool {
        return !$this->same($field, $confirmField);
    }


    /**
     * @param $field
     * @return bool
     */
    protected function strong_password($field): bool {
        if (!isset($this->data[$field])) {
            return false;
        }

        // Kiểm tra xem mật khẩu có ít nhất 8 ký tự, và chứa ít nhất một chữ hoa, một chữ thường, và một số
        $password = $this->data[$field];
        $containsUpperCase = preg_match('/[A-Z]/', $password);
        $containsLowerCase = preg_match('/[a-z]/', $password);
        $containsNumber = preg_match('/\d/', $password);
        $isValidLength = strlen($password) >= 8;

        return $containsUpperCase && $containsLowerCase && $containsNumber && $isValidLength;
    }


    /**
     * @param $field
     * @param $formats
     * @return bool
     */
    protected function file_format($field, $formats): bool {
        if (!isset($this->data[$field])) {
            return false;
        }

        $filePath = $this->data[$field]['name']; // Lấy tên tệp từ mảng dữ liệu

        // Chuyển đổi đối số định dạng thành một mảng nếu nó không phải là một mảng
        if (!is_array($formats)) {
            $formats = explode(',', $formats);

        }

        // Lấy phần mở rộng của tệp
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Kiểm tra xem phần mở rộng có tồn tại trong danh sách định dạng được chấp nhận không
        return in_array($extension, $formats);
    }


    protected function unique($field, $table): bool {
        // Kiểm tra xem giá trị của trường đã tồn tại trong dữ liệu hay không
        return !isset($this->data[$field]) || $this->checkUnique($field, $this->data[$field], $table);
    }

//     Phương thức để kiểm tra tính duy nhất của trường trong cơ sở dữ liệu
    protected function checkUnique($field, $value, $table): bool {
        // Thực hiện truy vấn SQL để kiểm tra tính duy nhất của giá trị trong bảng cơ sở dữ liệu được truyền vào
        $query = "SELECT COUNT(*) FROM $table WHERE $field = :value";

        $result = $this->db->select($query, ['value' => $value]);

        $count = $result[0]['COUNT(*)']; // Lấy số lượng hàng từ kết quả truy vấn
        return $count === 0; // Trả về true nếu không có giá trị trùng lặp, ngược lại trả về false
    }



    protected function defaultMessage($rule, $field, $param = null): string {
        $defaultMessages = [
            'required' => "Trường $field không được để trống.",
            'min' => "Trường $field phải có ít nhất  $param ký tự.",
            'max' => "Trường $field trường không được lớn hơn $param ký tự.",
            'length' => "Trường $field trường phải có $param ký tự.",
            'phone' => "Trường $field không hợp lệ.",
            'email' => "Trường $field phải là địa chỉ email hợp lệ.",
            'unique' => "Trường $field đã tồn tại.",
            'numeric' => "Trường $field chỉ được nhập số.",
            'file_format' => "Trường $field không đúng định dạng.",
        ];

        return $defaultMessages[$rule];
    }
}