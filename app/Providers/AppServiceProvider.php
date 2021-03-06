<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use App\View\Components\Button\Button;
use App\View\Components\Button\Modal as BtnModal;
use App\View\Components\Modal\Modal;
use App\Models\Appointment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(255);

        Paginator::useBootstrap();

        Blade::component('btn', Button::class);
        Blade::component('btn-modal', BtnModal::class);
        Blade::component('modal', Modal::class);

        //View::composer('*', function ($view) {
        //    $appointment_notification = Appointment::where('status', 'Pending')->latest()->get();
        //    $view->with('appointment_notification', $appointment_notification);
        //});

        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        view()->composer('*', function ($view) {
            //$view->getName();
            $route = Route::currentRouteName();//currentRouteAction
            //$action = substr($route, strpos($route, '@') + 1);
            $action = explode(".", $route);
            $view->with('action', end($action));
        });
    }
}
