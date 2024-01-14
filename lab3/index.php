<?php

require 'vendor/autoload.php';

use App\Core\Database;
use App\Controllers\Admin\DashboardController;

use App\Models\BaseModel;
use App\Controllers\BaseController;
use App\Core\Route;

use App\Models\UserModel;


$db = new Database();

$baseModel = new BaseModel();
$baseController = new BaseController();
$route = new Route();

$dashboard = new DashboardController();


// $user = new UserModel();

// echo "<pre>";
// print_r($user->getEmailUsers());
// echo "<pre>";