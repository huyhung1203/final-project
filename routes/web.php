<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\Caster\CutStub;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::get('customer/result', [CustomerController::class, 'searchProduct'])->name('customer.search');
Route::get('list-product-status/{status}', [CustomerController::class, 'productStatus'])->name('customer.status');
Route::get('product-type/{type_id}', [CustomerController::class, 'typeOne'])->name('customer.typeOne');
Route::resource('customer', CustomerController::class);
Route::get('user-register', [CustomerController::class, 'getUserRegister'])->name('show-user-register');
Route::post('user-register', [CustomerController::class, 'userRegister'])->name('user-register');
Route::get('user-login', [CustomerController::class, 'getUserLogin'])->name('show-user-login');
Route::post('user-login', [CustomerController::class, 'userLogin'])->name('user-login');
Route::get('user-logout', [CustomerController::class, 'userLogout'])->name('user-logout');
Route::get('infor-user/{id}', [CustomerController::class, 'getInfor'])->name('user-infor');
Route::post('infor-user/{id}', [CustomerController::class, 'updateInfor'])->name('user-infor-update');
Route::get('address-user/{id}', [CustomerController::class, 'getInforAddress'])->name('user-infor-add');
Route::post('address-user/{id}', [CustomerController::class, 'updateAddress'])->name('edit-address');
Route::get('product-detail/{id}', [CustomerController::class, 'detail'])->name('product-detail');

Route::get('get-list/{id}/{color}', [CustomerController::class, 'getSizeData'])
    ->name('getsize');
Route::get('/get-sizes', 'CustomerController@getSizesByColor');
Route::get('get-detail-id/{id}/{color}/{size}', [CustomerController::class, 'getDetailId'])
    ->name('getdetailid');
Route::get('product-list', [CustomerController::class, 'getList'])->name('getList');
Route::get('product-list-fillter', [CustomerController::class, 'fillter'])->name('fillter-product');
Route::get('cart', [CustomerController::class, 'cart'])->name('cart');
Route::post('add-to-cart/{id}', [CustomerController::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [CustomerController::class, 'updateCart'])->name('update_cart');
Route::delete('remove-from-cart', [CustomerController::class, 'remove'])->name('remove_from_cart');
Route::get('check-out', [CustomerController::class, 'checkout'])->name('check_out');
Route::get('register-user', [CustomerController::class, 'register'])->name('register');
Route::post('payment', [CustomerController::class, 'payment'])->name('payment');
Route::GET('get-district/{city}', [CustomerController::class, 'getDistrict'])->name('getDistrict');
Route::GET('get-ward/{district}', [CustomerController::class, 'getWard'])->name('getWard');
Route::GET('history-invoice/{id}', [CustomerController::class, 'history'])->name('history');
Route::get('history-detail/{id}', [CustomerController::class, 'historyDetail'])->name('history-detail');
Route::get('cancel/{id}', [CustomerController::class, 'cancelInvoice'])->name('cancel.invoice');



Route::group(['middleware' => 'Logout'], function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/check', [LoginController::class, 'login'])->name('check.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('check.logout');
    Route::group(['prefix' => '/', 'middleware' => 'CheckAdmin'], function () {
        Route::get('/admin/get-data-chart', [AdminController::class, 'getChartData']);
        Route::resource('admin', AdminController::class);
        Route::resource('brand', BrandController::class);
        Route::resource('type', TypeController::class);
        Route::resource('size', SizeController::class);
        Route::resource('color', ColorController::class);
        Route::get('product/sold-out', [ProductController::class, 'productSold']);
        Route::get('product_detail/{id}', [ProductController::class, 'showDetail']);
        Route::post('product/edit-detail/{id}/{product_id}', [ProductController::class, 'updateDetail']);
        Route::resource('product', ProductController::class);
        Route::resource('invoice', InvoiceController::class);
        Route::resource('user', UserController::class);
        Route::get('product/remove-image/{id}', [ProductController::class, 'removeImg']);
        Route::post('/product/add-images/{id}', [ProductController::class, 'addImg']);
        Route::get('revenue', [RevenueController::class, 'index']);
        Route::get('revenue/detail/{month}', [RevenueController::class, 'detail'])->name('revenue.detail');
    });
});



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
