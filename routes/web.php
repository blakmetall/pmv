<?php

Route::group(['middleware' => ['web']], function () {

    // auth laravel routes
    Auth::routes(['register' => false]); // public register disabled for this app

    // language 
    Route::group(['prefix' => 'language'], function () {
        Route::get('update/{locale}', 'LanguageController@update')->name('language.update');
    });

    // error pages
    Route::group(['prefix' => 'error'], function() {
        Route::get('forbidden', 'ErrorController@forbidden')->name('error.forbidden');
        Route::get('not-found', 'ErrorController@notFound')->name('error.not-found');
    });

    // auth middleware
    Route::group(['prefix' => '', 'middleware' => 'auth'], function() {
        
        // dashboard
        Route::get('', 'DashboardController@index');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        // account 
        Route::group(['prefix' => 'account'], function () {
            Route::get('', 'AccountController@edit')->name('account');
            Route::post('update', 'AccountController@update')->name('account.update');
        });


        // profile 
        Route::group(['prefix' => 'profile'], function () {
            Route::get('', 'ProfileController@edit')->name('profile');
            Route::post('update', 'ProfileController@update')->name('profile.update');
        });

        // users
        Route::group(['prefix' => 'users'], function () {

            Route::group(['middleware' => 'role-permission:users,index'], function() {
                Route::get('', 'UsersController@index')->name('users');
                Route::get('create', 'UsersController@create')->name('users.create');
                Route::post('store', 'UsersController@store')->name('users.store');
                Route::get('show/{user}', 'UsersController@show')->name('users.show');
                Route::get('edit/{user}', 'UsersController@edit')->name('users.edit');
                Route::post('update/{id}', 'UsersController@update')->name('users.update');
                Route::get('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
            });
            
            // roles
            Route::group(['prefix' => 'roles'], function () {
                Route::group(['middleware' => 'role-permission:users,roles'], function() {
                    Route::get('', 'RolesController@index')->name('roles');
                });
                
                Route::get('update-active/{id}', 'RolesController@updateActive')->name('roles.update-active');
            });
        });

        // contractors
        Route::group(['prefix' => 'contractors'], function () {

            Route::group(['middleware' => 'role-permission:users,index'], function() {
                Route::get('', 'ContractorsController@index')->name('contractors');
                Route::get('create', 'ContractorsController@create')->name('contractors.create');
                Route::post('store', 'ContractorsController@store')->name('contractors.store');
                Route::get('show/{contractor}', 'ContractorsController@show')->name('contractors.show');
                Route::get('edit/{contractor}', 'ContractorsController@edit')->name('contractors.edit');
                Route::post('update/{id}', 'ContractorsController@update')->name('contractors.update');
                Route::get('destroy/{id}', 'ContractorsController@destroy')->name('contractors.destroy');
            });
        });

        // properties
        Route::group(['prefix' => 'properties', 'middleware' => 'role-permission:properties,index'], function () {
            Route::get('', 'PropertiesController@index')->name('properties');
            Route::post('store', 'PropertiesController@store')->name('properties.store');
            Route::get('create', 'PropertiesController@create')->name('properties.create');
            Route::get('show/{property}', 'PropertiesController@show')->name('properties.show');
            Route::get('edit/{property}', 'PropertiesController@edit')->name('properties.edit');
            Route::post('update/{id}', 'PropertiesController@update')->name('properties.update');
            Route::get('destroy/{id}', 'PropertiesController@destroy')->name('properties.destroy');
        });

        // settings
        Route::group(['prefix' => 'settings'], function() {

            Route::get('', 'SettingsController@index')->name('settings');

            // zones
            Route::group(['prefix' => 'zones', 'middleware' => 'role-permission:settings,zones'], function () {
                Route::get('', 'ZonesController@index')->name('zones');
                Route::get('create', 'ZonesController@create')->name('zones.create');
                Route::post('store', 'ZonesController@store')->name('zones.store');
                Route::get('show/{zone}', 'ZonesController@show')->name('zones.show');
                Route::get('edit/{zone}', 'ZonesController@edit')->name('zones.edit');
                Route::post('update/{id}', 'ZonesController@update')->name('zones.update');
                Route::get('destroy/{id}', 'ZonesController@destroy')->name('zones.destroy');
            });
    
            // amenities
            Route::group(['prefix' => 'amenities', 'middleware' => 'role-permission:settings,amenities'], function () {
                Route::get('', 'AmenitiesController@index')->name('amenities');
                Route::get('create', 'AmenitiesController@create')->name('amenities.create');
                Route::post('store', 'AmenitiesController@store')->name('amenities.store');
                Route::get('show/{amenity}', 'AmenitiesController@show')->name('amenities.show');
                Route::get('edit/{amenity}', 'AmenitiesController@edit')->name('amenities.edit');
                Route::post('update/{id}', 'AmenitiesController@update')->name('amenities.update');
                Route::get('destroy/{id}', 'AmenitiesController@destroy')->name('amenities.destroy');
            });
            
            // cleaning options
            Route::group(['prefix' => 'cleaning-options', 'middleware' => 'role-permission:settings,cleaning-options'], function () {
                Route::get('', 'CleaningOptionsController@index')->name('cleaning-options');
                Route::get('create', 'CleaningOptionsController@create')->name('cleaning-options.create');
                Route::post('store', 'CleaningOptionsController@store')->name('cleaning-options.store');
                Route::get('show/{cleaning_option}', 'CleaningOptionsController@show')->name('cleaning-options.show');
                Route::get('edit/{cleaning_option}', 'CleaningOptionsController@edit')->name('cleaning-options.edit');
                Route::post('update/{id}', 'CleaningOptionsController@update')->name('cleaning-options.update');
                Route::get('destroy/{id}', 'CleaningOptionsController@destroy')->name('cleaning-options.destroy');
            });

            // damage deposit
            Route::group(['prefix' => 'damage-deposits', 'middleware' => 'role-permission:settings,damage-deposits'], function () {
                Route::get('', 'DamageDepositsController@index')->name('damage-deposits');
                Route::get('create', 'DamageDepositsController@create')->name('damage-deposits.create');
                Route::post('store', 'DamageDepositsController@store')->name('damage-deposits.store');
                Route::get('show/{damage_deposit}', 'DamageDepositsController@show')->name('damage-deposits.show');
                Route::get('edit/{damage_deposit}', 'DamageDepositsController@edit')->name('damage-deposits.edit');
                Route::post('update/{id}', 'DamageDepositsController@update')->name('damage-deposits.update');
                Route::get('destroy/{id}', 'DamageDepositsController@destroy')->name('damage-deposits.destroy');
            });
    
            // cities
            Route::group(['prefix' => 'cities', 'middleware' => 'role-permission:settings,cities'], function () {
                Route::get('', 'CitiesController@index')->name('cities');
                Route::get('create', 'CitiesController@create')->name('cities.create');
                Route::post('store', 'CitiesController@store')->name('cities.store');
                Route::get('show/{city}', 'CitiesController@show')->name('cities.show');
                Route::get('edit/{city}', 'CitiesController@edit')->name('cities.edit');
                Route::post('update/{id}', 'CitiesController@update')->name('cities.update');
                Route::get('destroy/{id}', 'CitiesController@destroy')->name('cities.destroy');
            });
    
            // transaction types
            Route::group(['prefix' => 'transaction-types', 'middleware' => 'role-permission:settings,transaction-types'], function () {
                Route::get('', 'TransactionTypesController@index')->name('transaction-types');
                Route::get('create', 'TransactionTypesController@create')->name('transaction-types.create');
                Route::post('store', 'TransactionTypesController@store')->name('transaction-types.store');
                Route::get('show/{transaction_type}', 'TransactionTypesController@show')->name('transaction-types.show');
                Route::get('edit/{transaction_type}', 'TransactionTypesController@edit')->name('transaction-types.edit');
                Route::post('update/{id}', 'TransactionTypesController@update')->name('transaction-types.update');
                Route::get('destroy/{id}', 'TransactionTypesController@destroy')->name('transaction-types.destroy');
            });
        });
    });
});
