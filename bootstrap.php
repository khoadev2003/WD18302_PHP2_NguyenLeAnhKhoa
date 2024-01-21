<?php
require_once "vendor/autoload.php";


define('_DIR_ROOT', __DIR__);

//Xử lý http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://'.$_SERVER['HTTP_HOST'];
}else {
    $web_root = 'http://'.$_SERVER['HTTP_HOST'];
}

$dirRoot = str_replace('\\', '/', _DIR_ROOT);
$documentRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);

$folder = str_replace(strtolower($documentRoot), '', strtolower($dirRoot));
$web_root = $web_root . $folder;


// Main url
define('_WEB_ROOT', $web_root);

//End Xử lý http root


require_once 'routes/web.php';


