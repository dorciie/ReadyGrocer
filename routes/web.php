<?php
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ForgotPasswordController;
// customer controller.......................................................
// shop controller.......................................................
use App\Http\Controllers\shopOwnerController;
use App\Http\Controllers\custDashboardController;
use App\Http\Controllers\GroceryListController;
use App\Http\Controllers\custShopController;
use App\Http\Controllers\GroceryCartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopItemController;
use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\ViewOrderController;
use App\Http\Controllers\ShopProfileController;
use App\Http\Controllers\PromotionController;
use App\Models\customer;
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

Route::get('/test', function () {
    return view('customer/cart/test');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('RegisterController','App\Http\Controllers\RegisterController@index');
Route::resource('register', 'App\Http\Controllers\RegisterController');
Route::get('/registerShop', function () {return view('shop.auth.registerShop');})->name('registerShop');
Route::get('resendEmailCust/{custID}', [RegisterController::class, 'resendEmail'])->name('resendEmailCust');
Route::get('resendEmailShop/{shopID}', [RegisterController::class, 'resendEmailShop'])->name('resendEmailShop');

Route::get('verified/{custID}', [RegisterController::class, 'edit'])->name('verified');
Route::post('verified/{custID}', [RegisterController::class, 'edit'])->name('verified');

Route::get('verifiedShop/{shopID}', [RegisterController::class, 'show'])->name('verified');
Route::post('verifiedShop/{shopID}', [RegisterController::class, 'show'])->name('verified');

// customer........................................
Route::get('customer/custLogin',[LoginController::class,'login'])->middleware('AlreadyLoggedIn');
Route::post('check',[LoginController::class,'check'])->name('auth.check'); //apply this at login page
Route::get('dashboard', [LoginController::class,'custDashboard'])->name('custDashboard')->middleware('isLogged');
Route::get('Custlogout',[LogoutController::class,'Custlogout']);
Route::get('customer/forgot_password',[ForgotPasswordController::class,'forgot']);
Route::post('customer/forgot_password',[ForgotPasswordController::class,'password']);
Route::get('customer/reset_password/{email}',[ForgotPasswordController::class,'reset']);
Route::post('customer/reset_password/{email}',[ForgotPasswordController::class,'resetPassword']);

Route::resource('shops', 'App\Http\Controllers\custShopController')->middleware('isLogged');

Route::get('itemCategory/{categoryID}', [custDashboardController::class,'listOfCategory'])->name('category');
Route::get('itemDetails/{itemID}', [custDashboardController::class,'itemdetails'])->name('itemDetails');
Route::get('groceryList', [custDashboardController::class,'list'])->name('groceryList')->middleware('isLogged');
Route::get('groceryCart', [custDashboardController::class,'cart'])->name('groceryCart')->middleware('isLogged');
Route::get('checkout', [GroceryCartController::class,'checkout'])->name('checkout')->middleware('isLogged');

Route::get('updateCart/{itemID}', [GroceryCartController::class,'cart'])->name('updateCart')->middleware('isLogged');
Route::get('updateCart2/{itemID}', [GroceryCartController::class,'cart2'])->name('updateCart2')->middleware('isLogged');
Route::get('editCartItem/{cartItemID}', [GroceryCartController::class,'update'])->name('editCartItem')->middleware('isLogged');

Route::get('updateList/{itemID}', [GroceryListController::class,'destroy'])->name('updateList')->middleware('isLogged');
Route::get('updateList2/{itemID}', [GroceryListController::class,'update'])->name('updateList2')->middleware('isLogged');
Route::get('addItemList/{itemID}', [GroceryListController::class,'index'])->name('addItemList');

Route::resource('custProfile', 'App\Http\Controllers\custProfileController')->middleware('isLogged');

Route::resource('custOrder', 'App\Http\Controllers\CustOrderController')->middleware('isLogged');







//.................................Shop Owner..............................................
//Authentication
Route::get('shop/shoplogin',[LoginController::class,'Shoplogin'])->middleware('ShopAlreadyLoggedIn');
Route::post('Shopcheck',[LoginController::class,'Shopcheck'])->name('shop.auth.check');//apply this at login page
Route::get('/shoplogout',[LogoutController::class,'Shoplogout']);
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
Route::get('order_customer',[ViewOrderController::class,'customer'])->middleware('ShopisLogged'); //show customer
Route::post('deliver_order',[ViewOrderController::class,'deliverOrder'])->name('deliver.order')->middleware('ShopisLogged'); //send email to deliver

//Shop profile Section
Route::resource('profile', 'App\Http\Controllers\ShopProfileController')->middleware('ShopisLogged');
Route::post('password_change',[ShopProfileController::class,'updatePassword'])->middleware('ShopisLogged');

//Promotion section
Route::resource('promotion', 'App\Http\Controllers\PromotionController')->middleware('ShopisLogged');
//every page lepas login kena letak middleware('ShopisLogged') so bila login as customer tkleh masuk dekat shop

// \PWA::routes();
