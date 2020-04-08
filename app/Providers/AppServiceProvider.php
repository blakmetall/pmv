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
        $this->registerAmenitiesRepo();
        $this->registerDamageDepositsRepo();
        $this->registerCleaningOptionsRepo();
        $this->registerContractorsRepo();
        $this->registerUsersRepo();
    }

    public function registerAmenitiesRepo() {
        $this->app->bind(
            \App\Repositories\AmenitiesRepositoryInterface::class,
            \App\Repositories\AmenitiesRepository::class
        );
    }

    public function registerContractorsRepo() {
        $this->app->bind(
            \App\Repositories\ContractorsRepositoryInterface::class,
            \App\Repositories\ContractorsRepository::class
        );
    }

    public function registerUsersRepo() {
        $this->app->bind(
            \App\Repositories\UsersRepositoryInterface::class,
            \App\Repositories\UsersRepository::class
        );
    }

    public function registerCleaningOptionsRepo() {
        $this->app->bind(
            \App\Repositories\CleaningOptionsRepositoryInterface::class,
            \App\Repositories\CleaningOptionsRepository::class
        );
    }   

    public function registerDamageDepositsRepo() {
        $this->app->bind(
            \App\Repositories\DemageDepositsRepositoryInterface::class,
            \App\Repositories\DamageDepositsRepository::class
        );
    }
}