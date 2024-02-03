<?php 

use App\Controllers\Admin\UserController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\TicketController;
use App\Controllers\Admin\AirportController;
use App\Controllers\Admin\AirlineController;


use App\Core\Route;


Route::get('/',[DashboardController::class,'index']);
Route::get('/admin',[DashboardController::class,'index']);

Route::get('/admin/dang-nhap',[UserController::class,'index']);
Route::post('/admin/dang-nhap',[UserController::class,'handleLogin']);
Route::get('/admin/quen-mat-khau',[UserController::class,'resetPassword']);
Route::get('/admin/dang-xuat',[UserController::class,'logout']);


Route::get('/admin/ve',[TicketController::class,'index']);
Route::get('/admin/them-ve',[TicketController::class,'add']);
Route::post('/admin/them-ve',[TicketController::class,'handleAddTicket']);

Route::get('/admin/hang-hang-khong',[AirlineController::class,'index']);
Route::get('/admin/them-hang-hang-khong',[AirlineController::class,'addAirline']);
Route::post('/admin/them-hang-hang-khong',[AirlineController::class,'handleAddAirline']);

Route::get('/admin/san-bay',[AirportController::class,'index']);
Route::get('/admin/them-san-bay',[AirportController::class,'addAirport']);
Route::post('/admin/them-san-bay',[AirportController::class,'handleAddAirport']);
Route::get('/admin/san-bay/cap-nhat',[AirportController::class,'updateAirport']);
Route::post('/admin/san-bay/cap-nhat',[AirportController::class,'handleUpdateAirport']);
Route::get('/admin/san-bay/xoa',[AirportController::class,'handleDeleteAirport']);



Route::get('/404',[DashboardController::class,'_404']);

Route::run();