<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CarService\HomeController;
use App\Http\Controllers\CarService\OrderController;
use App\Http\Controllers\Admin\TypeServicesController;
use App\Http\Controllers\CarService\ServiceController;
use App\Http\Controllers\CarService\TypeServiceController;
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



Route::get('/home', [App\Http\Controllers\CarService\HomeController::class, 'index'])->name('home');


Auth::routes();
Route::prefix('admin')->namespace('Admin')->group(function(){

    Route::get('/',[DashboardController::class, 'index'])->name('admin.home');

        //type-service
        Route::prefix('type-service')->group(function(){
            Route::get('/',[TypeServicesController::class, 'index'])->name('admin.type-service');
            Route::get('/create',[TypeServicesController::class, 'create'])->name('admin.type-service.create');
            Route::post('/store',[TypeServicesController::class, 'store'])->name('admin.type-service.store');
            Route::delete('/destroy/{id}',[TypeServicesController::class, 'destroy'])->name('admin.type-service.destroy');
            Route::get('/edit/{id}',[TypeServicesController::class, 'edit'])->name('admin.type-service.edit');
            Route::put('/update/{type_service}',[TypeServicesController::class, 'update'])->name('admin.type-service.update');
            Route::get('/province/{id}',[TypeServicesController::class, 'province'])->name('admin.type-service.province');
            Route::get('/county/{id}',[TypeServicesController::class, 'county'])->name('admin.type-service.county');
        });
  //user
  Route::prefix('user')->group(function(){
    Route::get('/',[UserController::class, 'index'])->name('admin.user');
    Route::get('/customer',[UserController::class, 'customer'])->name('admin.customer');
    Route::get('/create',[UserController::class, 'create'])->name('admin.user.create');
    Route::post('/store',[UserController::class, 'store'])->name('admin.user.store');
    Route::delete('/destroy/{user}',[UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/edit/{id}',[UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/update/{user}',[UserController::class, 'update'])->name('admin.user.update');
    Route::get('/province/{id}',[UserController::class, 'province'])->name('admin.user.province');
    Route::get('/county/{id}',[UserController::class, 'county'])->name('admin.user.county');
    Route::get('/verify/{user}',[UserController::class, 'verify'])->name('admin.user.vefiry');
    Route::get('/edit',[UserController::class, 'edit_profile'])->name('admin.user.edit-profile');

    Route::get('/report-order',[UserController::class, 'reportorder'])->name('admin.user.report-order');
});
     //service
  Route::prefix('service')->group(function(){
    Route::get('/',[ServicesController::class, 'index'])->name('admin.service');
    Route::get('/create/{id}',[ServicesController::class, 'create'])->name('admin.service.create');
    Route::post('/store',[ServicesController::class, 'store'])->name('admin.service.store');
    Route::delete('/destroy/{id}',[ServicesController::class, 'destroy'])->name('admin.service.destroy');
    Route::get('/edit/{service}',[ServicesController::class, 'edit'])->name('admin.service.edit');
    Route::put('/update/{service}',[ServicesController::class, 'update'])->name('admin.service.update');
    Route::get('/province/{id}',[ServicesController::class, 'province'])->name('admin.service.province');
    Route::get('/county/{id}',[ServicesController::class, 'county'])->name('admin.service.county');
    Route::get('/verify/{id}',[ServicesController::class, 'county'])->name('admin.service.vefiry');
  });
});

Route::prefix('car-service')->namespace('CarService')->group(function(){

    Route::get('/',[HomeController::class, 'index'])->name('car-service.home');

    Route::get('/contact-us',[TypeServiceController::class, 'contact'])->name('car-service.contact-us');

    //typeservice
        Route::prefix('type-service')->group(function(){
        Route::get('/create',[TypeServiceController::class, 'create'])->name('car-service.type-service.create');
        Route::post('/store',[TypeServiceController::class, 'store'])->name('car-service.type-service.store');

    });

        //order
        Route::prefix('order')->group(function(){
            Route::get('/',[OrderController::class, 'index'])->name('car-service.order');

            Route::get('/report-order/{id}',[OrderController::class, 'reportorder'])->name('car-service.order.reportorder');

            Route::get('/search-report-order/{id}/{type_service}',[OrderController::class, 'search_report_order'])->name('car-service.service.searchreportorder');


            Route::get('/create',[OrderController::class, 'create'])->name('car-service.order.create');
            Route::post('/store',[OrderController::class, 'store'])->name('car-service.order.store');

            Route::get('/province/{id}',[OrderController::class, 'province'])->name('car-service.order.province');
            Route::get('/county/{id}',[OrderController::class, 'county'])->name('car-service.order.county');
            Route::get('/order_type_service/{id}',[OrderController::class, 'order_type_service'])->name('car-service.service.order-type-service');
            Route::get('/search_type_service/{id}/{type_service}',[OrderController::class, 'search_type_service'])->name('car-service.order.search-type-service');

        });
  //user
  Route::prefix('user')->group(function(){

    Route::get('/edit',[UserController::class, 'edituser'])->name('car-service.user.edit');
    Route::get('/message/{id}/{type}',[UserController::class, 'message'])->name('car-service.user.message');
    Route::get('/message/status/{id}/{status}',[UserController::class, 'status'])->name('car-service.user.message.status');
    Route::get('/message/rate/{id}/{rate}',[UserController::class, 'rate'])->name('car-service.user.message.rate');
    Route::get('/recharge/',[UserController::class, 'recharge'])->name('car-service.user.recharge');
    Route::put('/recharge/pay/{user}',[UserController::class, 'pay'])->name('car-service.user.recharge.pay');
    Route::get('/verify',[UserController::class, 'verifyy'])->name('car-service.user.verify');
    Route::get('/recharge/receipt/{referenceId}',[UserController::class, 'receipt'])->name('car-service.user.receipt');
    Route::put('/update/{user}',[UserController::class, 'updateuser'])->name('car-service.user.update');

    });
     //service
  Route::prefix('service')->group(function(){

    Route::get('/report-service/{id}',[OrderController::class, 'reportservice'])->name('car-service.service.reportservice');

    Route::get('/search-report-service/{id}/{type_service}',[OrderController::class, 'search_report_service'])->name('car-service.service.searchreportservice');

    Route::get('/',[ServiceController::class, 'index'])->name('car-service.service');
    Route::get('/create',[ServiceController::class, 'create'])->name('car-service.service.create')->middleware('check');

    Route::post('/store',[ServiceController::class, 'store'])->name('car-service.service.store');
    Route::delete('/destroy/{id}',[ServiceController::class, 'destroy'])->name('car-service.service.destroy');
    Route::get('/edit/{service}',[ServiceController::class, 'edit'])->name('car-service.service.edit');
    Route::put('/update/{service}',[ServiceController::class, 'update'])->name('car-service.service.update');
    Route::get('/province/{id}',[ServicesController::class, 'province'])->name('admin.service.province');
    Route::get('/county/{id}',[ServicesController::class, 'county'])->name('admin.service.county');
    Route::get('/verify/{id}',[ServicesController::class, 'county'])->name('admin.service.vefiry');
    });
});




//
