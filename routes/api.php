<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\Rol\RolesController;
use App\Http\Controllers\Admin\staff\StaffsController;
use App\Http\Controllers\Admin\Doctor\DoctorsController;
use App\Http\Controllers\Admin\Doctor\SpecialityController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group([
    // 'middleware' => 'auth:api',
    'prefix' => 'auth',
    //'middleware' =>['role:Super-Admin']   
    // 'middleware' =>['permission:publish articles']   
    // 'middleware' =>['auth:api','role:Super-Admin'],
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    Route::post('/list', [AuthController::class, 'list']);
    Route::post('/reg', [AuthController::class, 'reg']);
});

Route::group([
    'middleware' => 'auth:api',
], function ($router) {
    Route::resource('roles', RolesController::class);        
    Route::get('staffs/config', [StaffsController::class,"config"]);  
    Route::post('staffs/{id}', [StaffsController::class,"update"]);      
    Route::resource('staffs', StaffsController::class);    
    //
    Route::resource('specialities', SpecialityController::class);    
    // 
    Route::get("doctors/config",[DoctorsController::class,"config"]);
    Route::post("doctors/{id}",[DoctorsController::class,"update"]);
    Route::resource("doctors",DoctorsController::class);
});
