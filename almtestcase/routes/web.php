<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function () {
    return view('components.main');
});
Route::get('registrationform',function (){
    return view('components.register');
});
Route::get('authorizationform',function (){
    return view('components.auth');
});

Route::get('register',[AuthController::class,"signUp"]);

Route::get('auth', [AuthController::class,"login"]);

Route::get('make_req',[InfoController::class,"makeReq"])->middleware('auth');;
Route::get('update_req',[InfoController::class,"updateReq"])->middleware('auth');;
