<?php

use App\Core\Route;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\AirportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;


Route::get('/',[DashboardController::class,'index']);
Route::get('/admin',[DashboardController::class,'index']);

Route::get('/admin/dang-nhap',[LoginController::class,'index']);
Route::post('/admin/dang-nhap',[LoginController::class,'handleLogin']);
Route::get('/admin/quen-mat-khau',[LoginController::class,'resetPassword']);
Route::get('/admin/dang-xuat',[LoginController::class,'logout']);

Route::get('/admin/tai-khoan',[UserController::class,'listUser']);
Route::get('/admin/tai-khoan/them',[UserController::class,'addUser']);
Route::post('/admin/tai-khoan/them',[UserController::class,'handleAddUser']);
Route::get('/admin/tai-khoan/xoa',[UserController::class,'handleDeleteUser']);


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