<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\OperatingHourController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;

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

require __DIR__.'/auth.php';

Route::view('/pages/slick', 'pages.slick');
Route::view('/pages/datatables', 'pages.datatables');
Route::view('/pages/blank', 'pages.blank');


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {//['role:admin|merchant']]
    Route::group(['middleware' => ['role:admin|merchant']], function () {
        Route::resources([
            'appointment'       => AppointmentController::class,
            'dashboard'         => DashboardController::class,
            'employee'          => EmployeeController::class,
            'merchant'          => MerchantController::class,
            'operating_hour'    => OperatingHourController::class,
            'outlet'            => OutletController::class,
            'service'           => ServiceController::class
        ]);
    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resources([
            'industry'          => IndustryController::class,
            'user'              => UserController::class
        ]);
    });

    Route::get('calendar', [AppointmentController::class, 'calendar'])->name('calendar');
});

Route::group([], function ($subdomain) { //'subdomain' => '{merchant}.'.config('app.short_url')
    Route::resources([
        'appointment'       => App\Http\Controllers\AppointmentController::class,
    ]);

    Route::get('{merchant}', [App\Http\Controllers\AppointmentController::class, 'appointment'])->name('appointment');

    Route::view('/', 'landing');
});