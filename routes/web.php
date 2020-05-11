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
                
                Route::get('set-active/{id}', 'RolesController@setActive')->name('roles.set-active');
            });
        });

        // agents
        Route::group(['prefix' => 'agents'], function () {

            Route::group(['middleware' => 'role-permission:users,index'], function() {
                Route::get('', 'AgentsController@index')->name('agents');
                Route::get('create', 'AgentsController@create')->name('agents.create');
                Route::post('store', 'AgentsController@store')->name('agents.store');
                Route::get('show/{user}', 'AgentsController@show')->name('agents.show');
                Route::get('edit/{user}', 'AgentsController@edit')->name('agents.edit');
                Route::post('update/{id}', 'AgentsController@update')->name('agents.update');
                Route::get('destroy/{id}', 'AgentsController@destroy')->name('agents.destroy');
            });

        });

        // staff-groups
        Route::group(['prefix' => 'staff-groups', 'middleware' => 'role-permission:users,index'], function () {
            Route::get('', 'StaffGroupsController@index')->name('staff-groups');
            Route::get('create', 'StaffGroupsController@create')->name('staff-groups.create');
            Route::post('store', 'StaffGroupsController@store')->name('staff-groups.store');
            Route::get('show/{staff_group}', 'StaffGroupsController@show')->name('staff-groups.show');
            Route::get('edit/{staff_group}', 'StaffGroupsController@edit')->name('staff-groups.edit');
            Route::post('update/{id}', 'StaffGroupsController@update')->name('staff-groups.update');
            Route::get('destroy/{id}', 'StaffGroupsController@destroy')->name('staff-groups.destroy');
        });

        // contractors
        Route::group(['prefix' => 'contractors', 'middleware' => 'role-permission:users,index'], function () {
            Route::get('', 'ContractorsController@index')->name('contractors');
            Route::get('create', 'ContractorsController@create')->name('contractors.create');
            Route::post('store', 'ContractorsController@store')->name('contractors.store');
            Route::get('show/{contractor}', 'ContractorsController@show')->name('contractors.show');
            Route::get('edit/{contractor}', 'ContractorsController@edit')->name('contractors.edit');
            Route::post('update/{id}', 'ContractorsController@update')->name('contractors.update');
            Route::get('destroy/{id}', 'ContractorsController@destroy')->name('contractors.destroy');
        });

        // contractors-services
        Route::group(['prefix' => 'contractors-services', 'middleware' => 'role-permission:contractors,services'], function () {
            Route::get('', 'ContractorsServicesController@index')->name('contractors-services');
            Route::get('create', 'ContractorsServicesController@create')->name('contractors-services.create');
            Route::post('store', 'ContractorsServicesController@store')->name('contractors-services.store');
            Route::get('show/{service}', 'ContractorsServicesController@show')->name('contractors-services.show');
            Route::get('edit/{service}', 'ContractorsServicesController@edit')->name('contractors-services.edit');
            Route::post('update/{id}', 'ContractorsServicesController@update')->name('contractors-services.update');
            Route::get('destroy/{id}', 'ContractorsServicesController@destroy')->name('contractors-services.destroy');
        });

        // properties
        Route::group(['prefix' => 'properties', 'middleware' => 'role-permission:properties,index'], function () {
            Route::get('', 'PropertiesController@index')->name('properties');
            Route::get('create', 'PropertiesController@create')->name('properties.create');
            Route::post('store', 'PropertiesController@store')->name('properties.store');
            Route::get('show/{property}', 'PropertiesController@show')->name('properties.show');
            Route::get('edit/{property}', 'PropertiesController@edit')->name('properties.edit');
            Route::post('update/{id}', 'PropertiesController@update')->name('properties.update');
            Route::get('destroy/{id}', 'PropertiesController@destroy')->name('properties.destroy');

            // property routes
            Route::group(['prefix' => '{property}'], function () {

                // property notes
                Route::group(['prefix' => 'notes'], function () {
                    Route::get('', 'PropertyNotesController@index')->name('property-notes');
                    Route::get('create', 'PropertyNotesController@create')->name('property-notes.create');
                    Route::post('store', 'PropertyNotesController@store')->name('property-notes.store');
                    Route::get('show/{note}', 'PropertyNotesController@show')->name('property-notes.show');
                    Route::get('edit/{note}', 'PropertyNotesController@edit')->name('property-notes.edit');
                    Route::post('update/{id}', 'PropertyNotesController@update')->name('property-notes.update');
                    Route::get('destroy/{id}', 'PropertyNotesController@destroy')->name('property-notes.destroy');
                });

                // property contacts
                Route::group(['prefix' => 'contacts'], function () {
                    Route::get('', 'PropertyContactsController@index')->name('property-contacts');
                    Route::get('create', 'PropertyContactsController@create')->name('property-contacts.create');
                    Route::post('store', 'PropertyContactsController@store')->name('property-contacts.store');
                    Route::get('show/{contact}', 'PropertyContactsController@show')->name('property-contacts.show');
                    Route::get('edit/{contact}', 'PropertyContactsController@edit')->name('property-contacts.edit');
                    Route::post('update/{id}', 'PropertyContactsController@update')->name('property-contacts.update');
                    Route::get('destroy/{id}', 'PropertyContactsController@destroy')->name('property-contacts.destroy');
                });

                // property images
                Route::group(['prefix' => 'images'], function () {
                    Route::get('', 'PropertyImagesController@index')->name('property-images');
                    Route::get('create', 'PropertyImagesController@create')->name('property-images.create');
                    Route::post('store', 'PropertyImagesController@store')->name('property-images.store');
                    Route::get('show/{image}', 'PropertyImagesController@show')->name('property-images.show');
                    Route::get('edit/{image}', 'PropertyImagesController@edit')->name('property-images.edit');
                    Route::post('update/{id}', 'PropertyImagesController@update')->name('property-images.update');
                    Route::get('destroy/{id}', 'PropertyImagesController@destroy')->name('property-images.destroy');
                });

                // property management
                Route::group(['prefix' => 'property-management'], function () {
                    Route::get('', 'PropertyManagementController@index')->name('property-management');
                    Route::get('create', 'PropertyManagementController@create')->name('property-management.create');
                    Route::post('store', 'PropertyManagementController@store')->name('property-management.store');
                    Route::get('show/{pm}', 'PropertyManagementController@show')->name('property-management.show');
                    Route::get('edit/{pm}', 'PropertyManagementController@edit')->name('property-management.edit');
                    Route::post('update/{id}', 'PropertyManagementController@update')->name('property-management.update');
                    Route::get('destroy/{id}', 'PropertyManagementController@destroy')->name('property-management.destroy');
                });

                // property rates
                Route::group(['prefix' => 'rates'], function () {
                    Route::get('', 'PropertyRatesController@index')->name('property-rates');
                    Route::get('create', 'PropertyRatesController@create')->name('property-rates.create');
                    Route::post('store', 'PropertyRatesController@store')->name('property-rates.store');
                    Route::get('show/{rate}', 'PropertyRatesController@show')->name('property-rates.show');
                    Route::get('edit/{rate}', 'PropertyRatesController@edit')->name('property-rates.edit');
                    Route::post('update/{id}', 'PropertyRatesController@update')->name('property-rates.update');
                    Route::get('destroy/{id}', 'PropertyRatesController@destroy')->name('property-rates.destroy');
                });

            });
        });

        // cleaning-services
        Route::group(['prefix' => 'cleaning-services', 'middleware' => 'role-permission:users,index'], function () {
            Route::get('', 'CleaningServicesController@index')->name('cleaning-services');
            Route::get('create', 'CleaningServicesController@create')->name('cleaning-services.create');
            Route::post('store', 'CleaningServicesController@store')->name('cleaning-services.store');
            Route::get('show/{cleaning_service}', 'CleaningServicesController@show')->name('cleaning-services.show');
            Route::get('edit/{cleaning_service}', 'CleaningServicesController@edit')->name('cleaning-services.edit');
            Route::post('update/{id}', 'CleaningServicesController@update')->name('cleaning-services.update');
            Route::get('destroy/{id}', 'CleaningServicesController@destroy')->name('cleaning-services.destroy');
        });

        // cleaning-staff
        Route::group(['prefix' => 'cleaning-staff', 'middleware' => 'role-permission:users,index'], function () {
            Route::get('', 'CleaningStaffController@index')->name('cleaning-staff');
            Route::get('create', 'CleaningStaffController@create')->name('cleaning-staff.create');
            Route::post('store', 'CleaningStaffController@store')->name('cleaning-staff.store');
            Route::get('show/{cleaning_staff}', 'CleaningStaffController@show')->name('cleaning-staff.show');
            Route::get('edit/{cleaning_staff}', 'CleaningStaffController@edit')->name('cleaning-staff.edit');
            Route::post('update/{id}', 'CleaningStaffController@update')->name('cleaning-staff.update');
            Route::get('destroy/{id}', 'CleaningStaffController@destroy')->name('cleaning-staff.destroy');
        });

        // property management transactions
        Route::group(['prefix' => 'property-management'], function () {
            Route::group(['prefix' => '{pm}'], function () {
                Route::group(['prefix' => 'transactions'], function () {
                    Route::get('', 'PropertyManagementTransactionsController@index')->name('property-management-transactions');
                    Route::get('create', 'PropertyManagementTransactionsController@create')->name('property-management-transactions.create');
                    Route::post('store', 'PropertyManagementTransactionsController@store')->name('property-management-transactions.store');
                    Route::get('show/{transaction}', 'PropertyManagementTransactionsController@show')->name('property-management-transactions.show');
                    Route::get('edit/{transaction}', 'PropertyManagementTransactionsController@edit')->name('property-management-transactions.edit');
                    Route::post('update/{id}', 'PropertyManagementTransactionsController@update')->name('property-management-transactions.update');
                    Route::get('destroy/{id}', 'PropertyManagementTransactionsController@destroy')->name('property-management-transactions.destroy');
                });
            });
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
            
            // cleaning-options
            Route::group(['prefix' => 'cleaning-options', 'middleware' => 'role-permission:settings,cleaning-options'], function () {
                Route::get('', 'CleaningOptionsController@index')->name('cleaning-options');
                Route::get('create', 'CleaningOptionsController@create')->name('cleaning-options.create');
                Route::post('store', 'CleaningOptionsController@store')->name('cleaning-options.store');
                Route::get('show/{cleaning_option}', 'CleaningOptionsController@show')->name('cleaning-options.show');
                Route::get('edit/{cleaning_option}', 'CleaningOptionsController@edit')->name('cleaning-options.edit');
                Route::post('update/{id}', 'CleaningOptionsController@update')->name('cleaning-options.update');
                Route::get('destroy/{id}', 'CleaningOptionsController@destroy')->name('cleaning-options.destroy');
            });

            // damage-deposit
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
    
            // transaction-types
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
