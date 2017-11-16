<?php

namespace App\Providers;

use App\Aspect\UoWAspect;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;


class AopServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UoWAspect::class, function (Application $app) {
            return new UoWAspect($app->make(UoWAspect::class));
        });

        $this->app->tag([UoWAspect::class], 'goaop.aspect');
    }
}
