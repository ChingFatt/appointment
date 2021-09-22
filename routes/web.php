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

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {//['role:admin|merchant']]
    Route::get('/impersonate_leave', [UserController::class, 'impersonate_leave'])->name('impersonate.leave');
    Route::group(['middleware' => ['role:admin|merchant']], function () {
        Route::resource('outlet.operating_hour', OperatingHourController::class)->shallow();
        Route::resources([
            'appointment'       => AppointmentController::class,
            'dashboard'         => DashboardController::class,
            'employee'          => EmployeeController::class,
            'merchant'          => MerchantController::class,
            'outlet'            => OutletController::class,
            'service'           => ServiceController::class
        ]);
    });
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resources([
            'industry'          => IndustryController::class,
            'user'              => UserController::class
        ]);
        Route::get('/impersonate/{user_id}', [UserController::class, 'impersonate'])->name('impersonate');

    });
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('calendar', [AppointmentController::class, 'calendar'])->name('calendar');
});

Route::group([], function ($subdomain) { //'subdomain' => '{merchant}.'.config('app.short_url')
    Route::resources([
        'appointment'       => App\Http\Controllers\AppointmentController::class,
    ]);
    Route::get('{merchant}', [App\Http\Controllers\AppointmentController::class, 'appointment'])->name('appointment');
    Route::get('/', function () {
        return view('landing');
    })->name('landing');
});