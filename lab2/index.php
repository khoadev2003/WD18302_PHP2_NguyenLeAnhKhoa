<?php

require 'vendor/autoload.php';

use App\Core\Database;
use App\Controllers\Admin\DashboardController;

use App\Models\BaseModel;
use App\Controllers\BaseController;
use App\Core\Route;


$db = new Database();

$baseModel = new BaseModel();
$baseController = new BaseController();
$route = new Route();

$dashboard = new DashboardController();