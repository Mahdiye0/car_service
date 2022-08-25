<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TypeServicesController as TypeServicesAdminController;

use App\Http\Controllers\CarService\HomeController;
use App\Http\Controllers\CarService\OrderController;
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

//----------------------  admin ---------------------
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('home');
        //===== type-service
        Route::prefix('type-service')->name('type-service.')->controller(TypeServicesAdminController::class)->group(function () {
            Route::get('/',  'index')->name('type-service');
            Route::get('/create',  'create')->name('create');
            Route::post('/store', 'store')->name(' store');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/edit/{id}',  'edit')->name('edit');
            Route::put('/update/{type_service}', 'update')->name('update');
            Route::get('/province/{id}',  'province')->name('province');
            Route::get('/county/{id}',  'county')->name('county');
        });

        //======== user
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('/');
            Route::get('/customer',  'customer')->name('customer');
            Route::get('/create',  'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::delete('/destroy/{user}',  'destroy')->name('destroy');
            Route::get('/edit/{id}',  'edit')->name('edit');
            Route::put('/update/{user}', 'update')->name('update');
            Route::get('/province/{id}',  'province')->name('province');
            Route::get('/county/{id}', 'county')->name('county');
            Route::get('/verify/{user}', 'verify')->name('vefiry');
            Route::get('/edit',  'edit_profile')->name('edit-profile');
            Route::get('/report-order',  'reportorder')->name('report-order');
        });

        //=========== service
        Route::prefix('service')->name('service.')->controller(ServicesController::class)->group(function () {
            Route::get('/',  'index')->name('/');
            Route::get('/create/{id}', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::delete('/destroy/{id}',  'destroy')->name('destroy');
            Route::get('/edit/{service}', 'edit')->name('edit');
            Route::put('/update/{service}',  'update')->name('update');
            Route::get('/province/{id}',  'province')->name('province');
            Route::get('/county/{id}',  'county')->name('county');
            Route::get('/verify/{id}', 'county')->name('vefiry');
        });
    });


    //--------------  car-service ----------------------
    Route::prefix('car-service')->name('car-service.')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/contact-us', [TypeServiceController::class, 'contact'])->name('contact-us');

        //========= typeservice
        Route::prefix('type-service')->group(function () {
            Route::get('/create', [TypeServiceController::class, 'create'])->name('type-service.create');
            Route::post('/store', [TypeServiceController::class, 'store'])->name('type-service.store');
        });

        //========= order
        Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/report-service/{id}', 'reportservice')->name('reportservice');
            Route::get('/report-order/{id}',  'reportorder')->name('reportorder');
            Route::get('/search-report-order/{id}/{type_service}', 'search_report_order')->name('searchreportorder'); //service
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/province/{id}', 'province')->name('province');
            Route::get('/county/{id}',  'county')->name('county');
            Route::get('/order_type_service/{id}',  'order_type_service')->name('order-type-service');
            Route::get('/search_type_service/{id}/{type_service}',  'search_type_service')->name('search-type-service');
        });

        //========= user
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
            Route::get('/edit',  'edituser')->name('edit');
            Route::get('/message/{id}/{type}', 'message')->name('message');
            Route::get('/message/status/{id}/{status}', 'status')->name('message.status');
            Route::get('/message/rate/{id}/{rate}', 'rate')->name('message.rate');
            Route::get('/recharge',  'recharge')->name('recharge');
            Route::put('/recharge/pay/{user}',  'pay')->name('recharge.pay');
            Route::get('/verify',  'verifyy')->name('verify');
            Route::get('/recharge/receipt/{referenceId}',  'receipt')->name('receipt');
            Route::put('/update/{user}', 'updateuser')->name('update');
        });

        //============ service
        Route::prefix('service')->name('service.')->controller(ServiceController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            // Route::get('/report-service/{id}', 'reportservice')->name('reportservice');
            Route::get('/search-report-service/{id}/{type_service}', 'search_report_service')->name('searchreportservice');
            Route::get('/create', 'create')->name('create')->middleware('check');
            Route::post('/store', 'store')->name('store');
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
            Route::get('/edit/{service}', 'edit')->name('edit');
            Route::put('/update/{service}', 'update')->name('update');
            Route::get('/province/{id}', 'province')->name('province'); //admin
            Route::get('/county/{id}', 'county')->name('county'); //admin
            Route::get('/verify/{id}', 'county')->name('vefiry'); //admin
        });
    });
});




//
