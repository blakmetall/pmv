<?php

namespace App\Providers;

use URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Helpers\AppHelper;

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
        if ( AppHelper::shouldApplyHttps() ) { 
            URL::forceScheme('https'); 
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()  {
        $this->registerRepositories();
    }

    public function registerRepositories() {
        $this->app->bind(
            \App\Repositories\AmenitiesRepositoryInterface::class,
            \App\Repositories\AmenitiesRepository::class,
            \App\Repositories\CleaningOptionsRepositoryInterface::class,
            \App\Repositories\CleaningOptionsRepository::class,
            \App\Repositories\ContractorsRepositoryInterface::class,
            \App\Repositories\ContractorsRepository::class,
            \App\Repositories\DemageDepositsRepositoryInterface::class,
            \App\Repositories\DamageDepositsRepository::class,
            \App\Repositories\UsersRepositoryInterface::class,
            \App\Repositories\UsersRepository::class
        );
    }
}