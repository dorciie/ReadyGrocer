<?php
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ForgotPasswordController;
// customer controller.......................................................
// shop controller.......................................................
use App\Http\Controllers\shopOwnerController;
use App\Http\Controllers\custDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopItemController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\ViewOrderController;
use App\Http\Controllers\ShopProfileController;
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
// Route::get('dashboardd',[LoginController::class,'custDashboard'])->middleware('isLogged');
Route::get('Custlogout',[LogoutController::class,'Custlogout']);
Route::get('customer/forgot_password',[ForgotPasswordController::class,'forgot']);
Route::post('customer/forgot_password',[ForgotPasswordController::class,'password']);
Route::get('customer/reset_password/{email}',[ForgotPasswordController::class,'reset']);
Route::post('customer/reset_password/{email}',[ForgotPasswordController::class,'resetPassword']);
Route::get('listofshops', [App\Http\Controllers\customerController::class, 'index'])->middleware('isLogged');
Route::get('shop/{shopID}',[App\Http\Controllers\customerController::class, 'shopdetails'])->name('shopdetails')->middleware('isLogged');
Route::get('favShop/{shopID}/',[App\Http\Controllers\customerController::class, 'favShop'])->name('favShop')->middleware('isLogged');
Route::get('dashboard', [LoginController::class,'custDashboard'])->middleware('isLogged');
Route::get('itemCategory', [custDashboardController::class,'listOfCategory'])->name('category');


//.................................Shop Owner..............................................
//Authentication
Route::get('shop/shoplogin',[LoginController::class,'Shoplogin'])->middleware('ShopAlreadyLoggedIn');
Route::post('Shopcheck',[LoginController::class,'Shopcheck'])->name('shop.auth.check');//apply this at login page
Route::get('shoplogout',[LogoutController::class,'Shoplogout']);
Route::get('shop/shopforgot_password',[ForgotPasswordController::class,'shopforgot']);
Route::post('shop/shopforgot_password',[ForgotPasswordController::class,'shoppassword']);
Route::get('shop/shopreset_password/{email}',[ForgotPasswordController::class,'shopreset']);
Route::post('shop/shopreset_password/{email}',[ForgotPasswordController::class,'shopresetPassword']);

//Shop Dashboard
Route::get('shop/dashboard',[shopOwnerController::class,'shopDashboard'])->middleware('ShopisLogged');

//Category section
Route::resource('category', 'App\Http\Controllers\CategoryController')->middleware('ShopisLogged');

//Item Section
Route::resource('item', 'App\Http\Controllers\ShopItemController')->middleware('ShopisLogged');

//Analysis Section
Route::resource('analysis', 'App\Http\Controllers\AnalysisController')->middleware('ShopisLogged');

//Order Section
Route::resource('order', 'App\Http\Controllers\ViewOrderController')->middleware('ShopisLogged');

//Shop profile Section
Route::resource('profile', 'App\Http\Controllers\ShopProfileController')->middleware('ShopisLogged');


//every page lepas login kena letak middleware('ShopisLogged') so bila login as customer tkleh masuk dekat shop