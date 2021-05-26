<?php
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ForgotPasswordController;
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
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('RegisterController','App\Http\Controllers\RegisterController@index');


// customer........................................
Route::get('customer/custLogin',[LoginController::class,'login'])->middleware('AlreadyLoggedIn');
Route::post('check',[LoginController::class,'check'])->name('auth.check'); //apply this at login page
Route::get('custDashboard',[LoginController::class,'custDashboard'])->middleware('isLogged');
Route::get('Custlogout',[LogoutController::class,'Custlogout']);
Route::get('customer/forgot_password',[ForgotPasswordController::class,'forgot']);
Route::post('customer/forgot_password',[ForgotPasswordController::class,'password']);
Route::get('customer/reset_password/{email}',[ForgotPasswordController::class,'reset']);
Route::post('customer/reset_password/{email}',[ForgotPasswordController::class,'resetPassword']);
Route::get('listofshops', [App\Http\Controllers\customerController::class, 'index']);
Route::get('{shopID}',[App\Http\Controllers\customerController::class, 'shopdetails'])->name('shopdetails');
Route::get('favShop/{shopID}/',[App\Http\Controllers\customerController::class, 'favShop'])->name('favShop');
Route::get('/dashboard', function () {
    return view('customer/dashboard');
});

//shop..............................................
Route::get('shop/shoplogin',[LoginController::class,'Shoplogin'])->middleware('ShopAlreadyLoggedIn');
Route::post('Shopcheck',[LoginController::class,'Shopcheck'])->name('shop.auth.check');//apply this at login page
Route::get('shopDashboard',[LoginController::class,'shopDashboard'])->middleware('ShopisLogged');
Route::get('shoplogout',[LogoutController::class,'Shoplogout']);
Route::get('shop/shopforgot_password',[ForgotPasswordController::class,'shopforgot']);
Route::post('shop/shopforgot_password',[ForgotPasswordController::class,'shoppassword']);
Route::get('shop/shopreset_password/{email}',[ForgotPasswordController::class,'shopreset']);
Route::post('shop/shopreset_password/{email}',[ForgotPasswordController::class,'shopresetPassword']);


