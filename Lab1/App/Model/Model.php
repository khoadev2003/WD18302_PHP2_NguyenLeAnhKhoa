<?php
//Model
function get_courses():array {
    global $courses;
    return array_values($courses);
}


/**
 * Hàm này kiểm tra khóa học có tồn tại
 * @param string $block
 * 
 * @return string
 */
function find_by_block($block) {
    global $courses;

    return array_key_exists($block, $courses) ? $courses[$block] :'Không tồn tại khóa học';
}


function get_user($email) {

    include_once "./config/config.php";


    $sql = "SELECT * FROM users WHERE email = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    }

    $con->close();
}


