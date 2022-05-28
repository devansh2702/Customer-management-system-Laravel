<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRMcontroller;
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

Route::get('/', function () {
    if (!isset($_SESSION)) {
        $errormsg="";
        return view('login',["errormsg"=>$errormsg]);    
    }


});
Route::get('/forgot',function(){
    return view('forgot');
});
Route::get('/payment/{id}',[CRMcontroller::class,'payment']);
Route::post('/payment/{id}',[CRMController::class,'sendmail']);
Route::post('/',[CRMcontroller::class,'login']);
Route::post('/forgot',[CRMcontroller::class,'forgotpassword']);
Route::view('/add','add');
Route::view('/home','home');
Route::post('/add',[CRMController::class,'add']);
Route::get('/update/{id}',[CRMcontroller::class,'update']);
Route::post('/update/{id}',[CRMController::class,'change']);
Route::get('/delete/{id}',[CRMController::class,'delete']);
