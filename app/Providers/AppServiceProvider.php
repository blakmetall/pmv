<?php

namespace App\Providers;

use URL;
use Validator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Helpers\AppHelper;
use App\Models\City;

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
        if (isProduction()) {
            URL::forceScheme('https');
        } else {
            //if local register your services you require for development
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        }

        // custom validations
        Validator::extend('is_even_string', function ($attribute, $value, $parameters, $validator) {
            if (!empty($value) && (strlen($value) % 2) == 0) {
                return false;
            }

            return true;
        });

        // configure cities for constants
        $getCities = City::orderBy('name', 'asc')->get();
        $cities = [];
        foreach ($getCities as $city) {
            $slug = Str::slug($city->name);
            $cities[$slug] = $city->id;
        }

        config(['constants.cities' => $cities]);

        // custom pagination
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator($this->forPage($page, $perPage), $total ?: $this->count(), $perPage, $page, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }

    public function registerRepositories()
    {

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
            \App\Repositories\CleaningServicesRepositoryInterface::class,
            \App\Repositories\CleaningServicesRepository::class
        );

        $this->app->bind(
            \App\Repositories\CleaningServicesStatusRepositoryInterface::class,
            \App\Repositories\CleaningServicesStatusRepository::class
        );

        $this->app->bind(
            \App\Repositories\ContactsRepositoryInterface::class,
            \App\Repositories\ContactsRepository::class
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
            \App\Repositories\DamageDepositsRepositoryInterface::class,
            \App\Repositories\DamageDepositsRepository::class
        );

        $this->app->bind(
            \App\Repositories\HumanResourcesRepositoryInterface::class,
            \App\Repositories\HumanResourcesRepository::class
        );

        $this->app->bind(
            \App\Repositories\OfficesRepositoryInterface::class,
            \App\Repositories\OfficesRepository::class
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
            \App\Repositories\PropertyImagesRepositoryInterface::class,
            \App\Repositories\PropertyImagesRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyManagementTransactionsRepositoryInterface::class,
            \App\Repositories\PropertyManagementTransactionsRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyManagementRepositoryInterface::class,
            \App\Repositories\PropertyManagementRepository::class
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
            \App\Repositories\RolesSectionsPermissionsRepositoryInterface::class,
            \App\Repositories\RolesSectionsPermissionsRepository::class
        );

        $this->app->bind(
            \App\Repositories\TransactionTypesRepositoryInterface::class,
            \App\Repositories\TransactionTypesRepository::class
        );

        $this->app->bind(
            \App\Repositories\TransactionSourcesRepositoryInterface::class,
            \App\Repositories\TransactionSourcesRepository::class
        );

        $this->app->bind(
            \App\Repositories\UsersRepositoryInterface::class,
            \App\Repositories\UsersRepository::class
        );

        $this->app->bind(
            \App\Repositories\WorkgroupsRepositoryInterface::class,
            \App\Repositories\WorkgroupsRepository::class
        );

        $this->app->bind(
            \App\Repositories\WorkgroupUsersRepositoryInterface::class,
            \App\Repositories\WorkgroupUsersRepository::class
        );

        $this->app->bind(
            \App\Repositories\ZonesRepositoryInterface::class,
            \App\Repositories\ZonesRepository::class
        );

        $this->app->bind(
            \App\Repositories\BuildingsRepositoryInterface::class,
            \App\Repositories\BuildingsRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyBookingsRepositoryInterface::class,
            \App\Repositories\PropertyBookingsRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyBookingsPaymentsRepositoryInterface::class,
            \App\Repositories\PropertyBookingsPaymentsRepository::class
        );

        $this->app->bind(
            \App\Repositories\PropertyCheckListRepositoryInterface::class,
            \App\Repositories\PropertyCheckListRepository::class
        );

        $this->app->bind(
            \App\Repositories\PagesRepositoryInterface::class,
            \App\Repositories\PagesRepository::class
        );

        $this->app->bind(
            \App\Repositories\PaymentMethodsRepositoryInterface::class,
            \App\Repositories\PaymentMethodsRepository::class
        );

        $this->app->bind(
            \App\Repositories\TestimonialsRepositoryInterface::class,
            \App\Repositories\TestimonialsRepository::class
        );

        $this->app->bind(
            \App\Repositories\AgenciesRepositoryInterface::class,
            \App\Repositories\AgenciesRepository::class
        );

        $this->app->bind(
            \App\Repositories\LgbtsRepositoryInterface::class,
            \App\Repositories\LgbtsRepository::class
        );
    }
}
