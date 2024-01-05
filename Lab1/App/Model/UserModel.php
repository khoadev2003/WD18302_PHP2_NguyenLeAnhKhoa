<?php

// Bài tập thêm 1.4
function get_all_users() {
    include_once "./config/config.php";

    $sql = "SELECT * FROM users";
    $stmt = $con->prepare($sql);
   
    $stmt->execute();

    $result = $stmt->get_result();
    $users = array();

    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $stmt->close();
    $con->close();

    return $users;
}