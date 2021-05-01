<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['middleware' => 'jwt_auth',], function ($router) {
    Route::apiResource('/user', 'UserController');
    Route::apiResource('/employee', 'EmployeeController');
    Route::get('/attendance', 'AttendanceLogController@index');
    Route::get('/attendance/{id}', 'AttendanceLogController@show');
    Route::post('/attendance/checkin', 'AttendanceLogController@storeChechIn');
    Route::post('/attendance/checkout', 'AttendanceLogController@storeChechOut');
    Route::get('/checkin_or_not', 'AttendanceLogController@checkedInOrNot');
    Route::get('/checkout_or_not', 'AttendanceLogController@checkedOutOrNot');
});
