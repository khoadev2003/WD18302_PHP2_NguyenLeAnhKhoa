<?php
/**
 * Hiển thị giá trị đó trong trường nhập liệu, giúp người dùng dễ dàng chỉnh sửa thông tin mà họ đã nhập trước đó.
 */
function old($key, $default = '')
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


/***
 * Lưu value của imput tạm thời vào SESSION
 */
function with($key, $value)
{
    $_SESSION['view_data'][$key] = $value;
}


function getError($key, $default = '')
{
    $value = isset($_SESSION['old_error'][$key]) ? $_SESSION['old_error'][$key] : null;

    if ($value !== null) {
        unset($_SESSION['old_error'][$key]); // Xóa giá trị sau khi sử dụng
        return $value;
    }

    $value = isset($_SESSION['error_data'][$key]) ? $_SESSION['error_data'][$key] : $default;
    unset($_SESSION['error_data'][$key]); // Xóa dữ liệu sau khi sử dụng

    return $value;
}

function setError($key, $value)
{
    $_SESSION['error_data'][$key] = $value;
}


/**
 * 
 * @return isset($_GET['param'])
 * 
 */
function hasGet($fieldName) {
    return isset($_GET[$fieldName]);
}

/**
 * 
 * @return isset($_POST['param'])
 * 
 */
function hasPost($fieldName) {
    return isset($_POST[$fieldName]);
}




function convertToSlug($inputString) {
    // Chuyển đổi chuỗi thành dạng không dấu, thay thế khoảng trắng bằng dấu gạch ngang và chuyển đổi mỗi từ thành chữ in thường
    $slug = strtolower(str_replace(' ', '-', trim($inputString)));

    return $slug;
}


/**
 * Đường dẫn public/+
 */
function asset($path) {
    // Đường dẫn đến thư mục chứa tài nguyên
    $baseURL = _WEB_ROOT .'/public/';  // Thay thế bằng đường dẫn thực tế của bạn

    // Nối đường dẫn tài nguyên với đường dẫn gốc và trả về
    return rtrim($baseURL, '/') . '/' . ltrim($path, '/');
}

function action($path) {
    // Đường dẫn đến thư mục chứa tài nguyên
    return _WEB_ROOT .'/'. $path;

    
}

function dd(...$args) {
    echo '<pre>';
    foreach ($args as $arg) {
        var_dump($arg);
    }
    echo '</pre>';
    die();
}

function isValidDate($inputDate) {
    // Chuyển đổi chuỗi ngày thành đối tượng DateTime
    $date = new DateTime($inputDate);

    // Lấy ngày hiện tại
    $today = new DateTime();

    // So sánh ngày hiện tại và ngày đầu vào
    return $date >= $today;
}