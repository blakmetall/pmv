<?php

namespace App\Providers;

use Config;
use URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // database mysql schema for strings
        Schema::defaultStringLength(191);

        // https force
        $apply_https = in_array(Config::get('app.env'), ['production', 'staging']);
        if ( $apply_https ) { URL::forceScheme('https'); }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   
        $this->app->bind(
            \App\Repositories\AmenitiesRepositoryInterface::class,
            \App\Repositories\AmenitiesRepository::class
        );
    }
}