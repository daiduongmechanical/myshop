<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\viewController;
use App\Http\Controllers\overView;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\vnpayController;
use App\Http\Controllers\billController;
use App\Http\Controllers\warehouseactionController;
use App\Http\Controllers\bannerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// rate route
Route::resource('rate', RateController::class)->middleware(['cors']);

//view route
Route::prefix('view')->group(function () {
    Route::middleware(['cors'])->controller(viewController::class)->group(function () {
        Route::post('/new', 'create');
    });
});

// bill controller

Route::prefix('bill')->group(function () {
    Route::middleware(['cors'])->controller(billController::class)->group(function () {
        Route::post('/add', 'addBill');
    });
});


//order route for user
Route::resource('order', orderController::class)->middleware(['cors'])->only([
    'store', 'show', 'create', 'update'
]);
//route to ORDER controller with admin 
Route::prefix('admin')->group(function () {
    Route::controller(orderController::class)->group(function () {
        //add middleware admin
        Route::get('/order', 'index');
        Route::get('/order/total', 'total');
        Route::get('/order/count', 'create');
        Route::get('/order/{id}', 'show');
    });
});

//warehouse action controller
Route::prefix('warehouse')->group(function () {
    Route::controller(warehouseactionController::class)->group(function () {
        Route::post('/make-dish', 'create');
        Route::post('/import-material', 'update');
    });
});


//overview routes
Route::prefix('admin')->group(function () {
    Route::middleware(['admin'])->controller(overView::class)->group(function () {
        Route::get('/overview/total', 'total');
    });
});


// route to cart controller
Route::resource('cart', CartController::class)->middleware(['cors']);






Route::prefix('menu')->group(function () {
    Route::middleware(['cors'])->controller(DishController::class)->group(function () {
        Route::get('/newdish-list', 'newDishList');
        Route::get('/bestrate-list', 'getRatelist');
        Route::get('/ingredient', 'ingredient');
        Route::post('/hello', 'hello');
    });
});
//rpoute to dish controller with user
Route::resource('menu', DishController::class)->middleware(['cors']);






//route to discount controller with admin 
Route::prefix('admin')->group(function () {
    Route::middleware(['admin'])->controller(DiscountController::class)->group(function () {
        Route::post('/newsale', 'store');
        Route::get('/allsale', 'all');
        Route::put('/updatediscount/{id}', 'update');
    });
});
// route to discount controller with user
Route::resource('discount', DiscountController::class)->middleware(['cors']);



//routeto user controller
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('update', 'update');
    Route::post('reset_password', 'resetPassword');
});

//login google
Route::get('/google-login', [GoogleController::class, 'redirectToAuth']);
Route::get('/google-callback', [GoogleController::class, 'handleAuthCallback']);

//login facebook
Route::get('/facebook-login', [FaceBookController::class, 'loginUsingFacebook']);
Route::get('/facebook-callback', [FaceBookController::class, 'callbackFromFacebook']);

//thanh toan voi vnpay
Route::post('/vnpay-checkout', [vnpayController::class, 'checkout']);

Route::prefix('banner')->group(function () {
    Route::controller(bannerController::class)->group(function () {
        Route::get('/all', 'all');
    });
});
