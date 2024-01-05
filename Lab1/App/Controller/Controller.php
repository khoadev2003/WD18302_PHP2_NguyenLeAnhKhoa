<?php


//Controller
$block = (!empty($_GET['block'])) ? $_GET['block'] : '';
$course_name = find_by_block($block);


//Lab 1.3
if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $user = get_user($email);
}else {
    $user = '';
}

