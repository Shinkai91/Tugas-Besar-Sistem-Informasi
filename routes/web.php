<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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
    return redirect(route('user.home'));
})->name('/');


#USER AUTHENTICATION
Route::get('/user/login','LoginController@ViewUserLogin')->name('user.login.view');
Route::post('/user/login','LoginController@AuthUserLogin')->name('user.login.auth');

Route::get('/user/register','LoginController@ViewUserRegister')->name('user.register.view');
Route::post('/user/register','LoginController@AuthUserRegister')->name('user.register.auth');

Route::get('/user','HomeController@HomeUser')->name('user.home');

#USER ORDER
Route::get('/user/order','OrderController@ViewOrder')->name('user.order');
Route::post('/user/order','OrderController@ProceedOrder')->name('user.order.proceed');
Route::get('/user/history','OrderController@ViewHistory')->name('user.history');



#ADMIN AUTHENTICATION
Route::get('/admin/login','LoginController@ViewAdminLogin')->name('admin.login.view');
Route::post('/admin/login','LoginController@AuthAdminLogin')->name('admin.login.auth');
Route::get('/admin','HomeController@HomeAdmin')->name('admin.home');

#ADMIN (ORDER)
Route::get('/admin/order','OrderController@ViewAdminOrder')->name('admin.home.order');
Route::get('/admin/order/delete/{id}','OrderController@DeleteOrder')->name('admin.home.order.delete');
Route::get('/admin/order/edit/{id}','OrderController@EditOrder')->name('admin.home.order.edit');
Route::post('/admin/order/update','OrderController@UpdateOrder')->name('admin.home.order.update');

#ADMIN (USER)
Route::get('/admin/user','UserController@ViewAdminUser')->name('admin.home.user');
Route::get('/admin/user/delete/{id}','UserController@DeleteUser')->name('admin.home.user.delete');
Route::get('/admin/user/edit/{id}','UserController@EditUser')->name('admin.home.user.edit');
Route::post('/admin/user/update','UserController@Updateuser')->name('admin.home.user.update');

#ADMIN (LAPTOP)
Route::get('/admin/laptop','LaptopController@ViewLaptop')->name('admin.home.laptop');
Route::post('/admin/laptop','LaptopController@AddLaptop')->name('admin.home.laptop.add');
Route::get('/admin/laptop/delete/{id}','LaptopController@DeleteLaptop')->name('admin.home.laptop.delete');
Route::get('/admin/laptop/edit/{id}','LaptopController@EditLaptop')->name('admin.home.laptop.edit');
Route::post('/admin/laptop/update','LaptopController@UpdateLaptop')->name('admin.home.laptop.update');


#OPERATOR AUTHENTICATION
Route::get('/operator/login','LoginController@ViewOperatorLogin')->name('operator.login.view');
Route::post('/operator/login','LoginController@AuthOperatorLogin')->name('operator.login.auth');
Route::get('/operator','HomeController@HomeOperator')->name('operator.home');

#OPERATOR (LAPTOP)
Route::get('/operator/laptop','LaptopController@ViewLaptopOperator')->name('operator.home.laptop');
Route::post('/operator/laptop/add/{id}', 'LaptopController@AddLaptopOperator')->name('operator.home.laptop.add');
Route::get('/operator/laptop/edit/{id}','LaptopController@EditLaptopOperator')->name('operator.home.laptop.edit');
Route::post('/operator/laptop/update', 'LaptopController@UpdateLaptopOperator')->name('operator.home.laptop.update');



#LOGOUT
Route::get('/logout','LoginController@logout')->name('logout');

#QUESTION
Route::get('/admin/question','QuestionController@ViewQuestion')->name('question.view');
Route::get('/admin/question/delete/{id}','QuestionController@DeleteQuestion')->name('question.delete');
Route::post('/question','QuestionController@AddQuestion')->name('question.add');