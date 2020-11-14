<?php

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


Route::get('/', function () {
    return view('welcome');
})->middleware('loginverifier');

Route::get('/roles','App\Http\Controllers\admincontroller@roles')->middleware('admin_restriction');
Route::get('/user','App\Http\Controllers\admincontroller@user')->middleware('admin_restriction');
Route::get('/expenses','App\Http\Controllers\admincontroller@expenses')->middleware('admin_restriction');
Route::get('/categoryexpense','App\Http\Controllers\admincontroller@category_expense')->middleware('admin_restriction');


Route::post('/newrole','App\Http\Controllers\admincontroller@newrole')->middleware('admin_restriction');
Route::post('/newuser','App\Http\Controllers\admincontroller@newuser')->middleware('admin_restriction');
Route::post('/newcategory','App\Http\Controllers\admincontroller@newcategory')->middleware('admin_restriction');
Route::post('/newexpense','App\Http\Controllers\admincontroller@newexpense')->middleware('admin_restriction');


Route::post('/updaterole','App\Http\Controllers\admincontroller@updaterole')->middleware('admin_restriction');
Route::get('/deleterole/{id}','App\Http\Controllers\admincontroller@deleterole')->middleware('admin_restriction');

Route::post('/updateuser','App\Http\Controllers\admincontroller@updateuser')->middleware('admin_restriction');
Route::get('/deleteuser/{id}','App\Http\Controllers\admincontroller@deleteuser')->middleware('admin_restriction');


Route::post('/updatecategory','App\Http\Controllers\admincontroller@updatecategory')->middleware('admin_restriction');
Route::get('/deletecategory/{id}','App\Http\Controllers\admincontroller@deletecategory')->middleware('admin_restriction');

Route::post('/updateexpense','App\Http\Controllers\admincontroller@updateexpenses')->middleware('admin_restriction');
Route::get('/deleteexpense/{id}','App\Http\Controllers\admincontroller@deleteexpense')->middleware('admin_restriction');


Route::get('/chart','App\Http\Controllers\admincontroller@chart')->middleware('admin_restriction');
Route::get('/userchart','App\Http\Controllers\usercontroller@chart')->middleware('user_restriction');



//user

Route::get('/userlayout','App\Http\Controllers\usercontroller@userlayout');
Route::get('/usermanagement','App\Http\Controllers\usercontroller@usermanagement')->middleware('user_restriction');
Route::get('/userexpenses','App\Http\Controllers\usercontroller@expenses')->middleware('user_restriction');

Route::get('/userdeleteexpense/{id}','App\Http\Controllers\usercontroller@userdeleteexpense')->middleware('user_restriction');
Route::post('/newuserexpense','App\Http\Controllers\usercontroller@usernewexpense')->middleware('user_restriction');
Route::post('/userupdateexpense','App\Http\Controllers\usercontroller@userupdateexpense')->middleware('user_restriction');

Route::post('/userchangepassword','App\Http\Controllers\usercontroller@changepassword')->middleware('user_restriction');

Route::post('/login','App\Http\Controllers\logincontroller@login');


Route::get('/logout','App\Http\Controllers\logincontroller@logout');