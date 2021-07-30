<?php

namespace App\Providers;

use App\Services\Html\HtmlBuilder;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends \Collective\Html\HtmlServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->app->singleton('form', function($app)
        {
            $form = new HtmlBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token());
            return $form->setSessionStore($app['session.store']);
        });
    }
}