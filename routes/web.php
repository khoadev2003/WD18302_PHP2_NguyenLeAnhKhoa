<?php 

use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\TicketController;
use App\Controllers\Admin\AirportController;
use App\Controllers\Admin\AirlineController;


use App\Core\Route;

$router = new Route;

Route::get('/',[DashboardController::class,'index']);
Route::get('/admin',[DashboardController::class,'index']);

Route::get('/admin/dang-nhap',[AuthController::class,'index']);
Route::post('/admin/dang-nhap',[AuthController::class,'checkLogin']);
Route::get('/admin/quen-mat-khau',[AuthController::class,'resetPassword']);


Route::get('/admin/ve',[TicketController::class,'index']);
Route::get('/admin/them-ve',[TicketController::class,'add']);
Route::post('/admin/them-ve',[TicketController::class,'postAddTicket']);

Route::get('/admin/hang-hang-khong',[AirlineController::class,'index']);
Route::get('/admin/them-hang-hang-khong',[AirlineController::class,'addAirline']);
Route::post('/admin/them-hang-hang-khong',[AirlineController::class,'checkAdd']);

Route::get('/admin/san-bay',[AirportController::class,'index']);
Route::get('/admin/them-san-bay',[AirportController::class,'addAirport']);
Route::post('/admin/them-san-bay',[AirportController::class,'checkAdd']);



Route::get('/404',[DashboardController::class,'_404']);

Route::run();