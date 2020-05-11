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
            \App\Repositories\AmenitiesRepository::class
        );

        $this->app->bind(
            \App\Repositories\CitiesRepositoryInterface::class,
            \App\Repositories\CitiesRepository::class
        );

        $this->app->bind(
            \App\Repositories\CleaningOptionsRepositoryInterface::class,
            \App\Repositories\CleaningOptionsRepository::class
        );

        $this->app->bind(
            \App\Repositories\ContractorsRepositoryInterface::class,
            \App\Repositories\ContractorsRepository::class
        );

        $this->app->bind(
            \App\Repositories\ContractorsServicesRepositoryInterface::class,
            \App\Repositories\ContractorsServicesRepository::class
        );

        $this->app->bind(
            \App\Repositories\CleaningServicesRepositoryInterface::class,
            \App\Repositories\CleaningServicesRepository::class
        );

        $this->app->bind(
            \App\Repositories\CleaningStaffRepositoryInterface::class,
            \App\Repositories\CleaningStaffRepository::class
        );

        $this->app->bind(
            \App\Repositories\DamageDepositsRepositoryInterface::class,
            \App\Repositories\DamageDepositsRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertiesRepositoryInterface::class,
            \App\Repositories\PropertiesRepository::class
        );
        
        $this->app->bind(
            \App\Repositories\PropertyContactsRepositoryInterface::class,
            \App\Repositories\PropertyContactsRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyManagementRepositoryInterface::class,
            \App\Repositories\PropertyManagementRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyManagementTransactionsRepositoryInterface::class,
            \App\Repositories\PropertyManagementTransactionsRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyNotesRepositoryInterface::class,
            \App\Repositories\PropertyNotesRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyRatesRepositoryInterface::class,
            \App\Repositories\PropertyRatesRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyTypesRepositoryInterface::class,
            \App\Repositories\PropertyTypesRepository::class
        );

        $this->app->bind(
            \App\Repositories\RolesRepositoryInterface::class,
            \App\Repositories\RolesRepository::class
        );

        $this->app->bind(
            \App\Repositories\TransactionTypesRepositoryInterface::class,
            \App\Repositories\TransactionTypesRepository::class
        );

        $this->app->bind(
            \App\Repositories\UsersRepositoryInterface::class,
            \App\Repositories\UsersRepository::class
        );

        $this->app->bind(
            \App\Repositories\ZonesRepositoryInterface::class,
            \App\Repositories\ZonesRepository::class
        );

        $this->app->bind(
            \App\Repositories\StaffGroupsRepositoryInterface::class,
            \App\Repositories\StaffGroupsRepository::class
        );

        $this->app->bind(
            \App\Repositories\HumanResourcesRepositoryInterface::class,
            \App\Repositories\HumanResourcesRepository::class
        );

        $this->app->bind(
            \App\Repositories\ContactsRepositoryInterface::class,
            \App\Repositories\ContactsRepository::class
        );
    }
}
