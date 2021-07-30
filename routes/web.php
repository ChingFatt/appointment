<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\OperatingHourController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\ServiceController;

use App\Http\Controllers\AppointmentController;

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


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::resources([
        'dashboard'         => DashboardController::class,
        'employee'          => EmployeeController::class,
        'industry'          => IndustryController::class,
        'merchant'          => MerchantController::class,
        'operating_hour'    => OperatingHourController::class,
        'outlet'            => OutletController::class,
        'service'           => ServiceController::class
    ]);
});

Route::group([], function () {
    Route::resources([
        'appointment'       => AppointmentController::class,
    ]);
});
