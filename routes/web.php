<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Materialcontroller;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\billController;
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



Route::middleware(['admin'])->prefix('product')->group(function () {
    Route::get('/index', [Productcontroller::class, 'index']);
    Route::get('/create', [Productcontroller::class, 'create']);
    Route::post('/create', [Productcontroller::class, 'newDish'])->name('product.newDish');
    Route::get('/update/{id}', [Productcontroller::class, 'update']);
    Route::post('/update-dish', [Productcontroller::class, 'updateData'])->name('product.update-data');
    Route::get('/delete-dish/{id}', [Productcontroller::class, 'delete']);
    Route::get('/old-dishes', [Productcontroller::class, 'oldDishes']);
    Route::get('/restore/{id}', [Productcontroller::class, 'restore']);
    Route::get('/force-delete/{id}', [Productcontroller::class, 'foreDelete']);
});

// user route

Route::middleware(['admin'])->prefix('user')->group(function () {
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/create', [UserController::class, 'create']);
    Route::post('/postCreate', [UserController::class, 'postCreate']);
    Route::get('/edit/{id}', [UserController::class, 'edit']);
    Route::post('/postEdit', [UserController::class, 'postEdit']);
    Route::get('/delete/{id}', [UserController::class, 'delete']);
    Route::get('/view/{id}', [UserController::class, 'view']);
    Route::get('/restore/{id}', [UserController::class, 'restore']);
    Route::get('/search', [UserController::class, 'search'])->name('search');
    Route::get('/searchAjax', [UserController::class, 'searchAjax'])->name('user.searchAjax');
});

//material route

Route::middleware(['admin'])->prefix('warehouse')->group(function () {
    Route::get('/index', [Materialcontroller::class, 'index']);
    Route::get('/create', [Materialcontroller::class, 'create']);
    Route::post('/postCreate', [Materialcontroller::class, 'postCreate']);
    Route::get('/edit/{id}', [Materialcontroller::class, 'edit']);
    Route::post('/postEdit', [Materialcontroller::class, 'postEdit']);
    Route::get('/delete/{id}', [Materialcontroller::class, 'delete']);
    Route::get('/view/{id}', [Materialcontroller::class, 'view']);
    Route::get('/overview', [Materialcontroller::class, 'overview']);
    Route::get('/history', [Materialcontroller::class, 'history']);
});

//discount route


Route::middleware(['admin'])->prefix('discount')->group(function () {
    Route::get('/index', [DiscountController::class, 'all']);
    Route::get('/create', [DiscountController::class, 'store']);
    Route::post('/postCreate', [DiscountController::class, 'postCreate']);
    Route::get('/edit/{id}', [DiscountController::class, 'edit']);
    Route::post('/postEdit', [DiscountController::class, 'postEdit']);
    Route::get('/delete/{id}', [DiscountController::class, 'delete']);
    Route::get('/view/{id}', [DiscountController::class, 'view']);
    Route::get('/discount/{discountId}/edit', 'DiscountController@showUpdateDiscountPage');
});

//overview controller
Route::middleware(['admin'])->prefix('overview')->group(function () {
    Route::get('/detail', [OverviewController::class, 'detail']);
    Route::get('/total', [OverviewController::class, 'total']);
    Route::get('/sortBy', [OverviewController::class, 'sortBy']);
    Route::get('/sortByDate', [OverviewController::class, 'sortByDate']);
    Route::get('/DishDetail', [OverviewController::class, 'DishDetail']);
});



//banner controller
Route::middleware(['admin'])->prefix('banner')->group(function () {
    Route::get('/index', [bannerController::class, 'index']);
    Route::get('/create', [bannerController::class, 'create']);
    Route::post('/postCreate', [bannerController::class, 'postCreate']);
    Route::get('/delete/{id}', [bannerController::class, 'delete']);
});

Route::middleware(['admin'])->prefix('bill')->group(function () {
    Route::get('/index', [billController::class, 'index']);
});

Route::get('/admin/logout', [AuthController::class, 'adminLogout']);
Route::get('/{id}', [OverviewController::class, 'handleToken']);

Route::middleware(['admin'])->get('/', [OverviewController::class, 'detail']);
