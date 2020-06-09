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
    Route::group(['prefix' => 'system', 'middleware' => 'auth'], function() {
        
        // dashboard
        Route::get('', 'DashboardController@index');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        // calendar
        Route::group(['prefix' => 'calendar', 'middleware' => 'role-permission:calendar,index'], function () {
            Route::get('', 'CalendarController@index')->name('calendar');
        });

        // bookings prefix
        Route::group(['prefix' => 'bookings'], function () {

            // all bookings
            Route::group(['middleware' => 'role-permission:bookings,index'], function () {
                Route::get('', 'BookingController@index')->name('bookings');
            });

            // bookings by property
            Route::group(['middleware' => 'role-permission:bookings,property'], function () {
                Route::get('property/{property}', 'BookingController@propertyBookings')->name('bookings.by-property');
            });
    
            // bookings by owner
            Route::group(['middleware' => 'role-permission:bookings,owner'], function () {
                Route::get('owner/{owner}', 'BookingController@ownerBookings')->name('bookings.by-owner');
            });

            // bookings by client user
            Route::group(['middleware' => 'role-permission:bookings,client'], function () {
                Route::get('client/{client}', 'BookingController@clientBookings')->name('bookings.by-client');
            });

            // agents
            Route::group(['prefix' => 'agents', 'middleware' => 'role-permission:bookings,agents'], function () {
                Route::get('', 'AgentsController@index')->name('agents');
            });
        });

        // properties prefix
        Route::group(['prefix' => 'properties'], function () {

            // properties 
            Route::group(['middleware' => 'role-permission:properties,index'], function () {
                Route::get('', 'PropertiesController@index')->name('properties');
                Route::get('create', 'PropertiesController@create')->name('properties.create');
                Route::post('store', 'PropertiesController@store')->name('properties.store');
                Route::get('show/{property}', 'PropertiesController@show')->name('properties.show');
                Route::get('edit/{property}', 'PropertiesController@edit')->name('properties.edit');
                Route::post('update/{id}', 'PropertiesController@update')->name('properties.update');
                Route::get('destroy/{id}', 'PropertiesController@destroy')->name('properties.destroy');

                // property internal routes
                Route::group(['prefix' => '{property}'], function () {

                    // property: property notes
                    Route::group(['prefix' => 'notes'], function () {
                        Route::get('', 'PropertyNotesController@index')->name('property-notes');
                        Route::get('create', 'PropertyNotesController@create')->name('property-notes.create');
                        Route::post('store', 'PropertyNotesController@store')->name('property-notes.store');
                        Route::get('show/{note}', 'PropertyNotesController@show')->name('property-notes.show');
                        Route::get('edit/{note}', 'PropertyNotesController@edit')->name('property-notes.edit');
                        Route::post('update/{id}', 'PropertyNotesController@update')->name('property-notes.update');
                        Route::get('destroy/{id}', 'PropertyNotesController@destroy')->name('property-notes.destroy');
                    });

                    // property: property contacts
                    Route::group(['prefix' => 'contacts'], function () {
                        Route::get('', 'PropertyContactsController@index')->name('property-contacts');
                        Route::get('create', 'PropertyContactsController@create')->name('property-contacts.create');
                        Route::post('store', 'PropertyContactsController@store')->name('property-contacts.store');
                        Route::get('show/{contact}', 'PropertyContactsController@show')->name('property-contacts.show');
                        Route::get('edit/{contact}', 'PropertyContactsController@edit')->name('property-contacts.edit');
                        Route::post('update/{id}', 'PropertyContactsController@update')->name('property-contacts.update');
                        Route::get('destroy/{id}', 'PropertyContactsController@destroy')->name('property-contacts.destroy');
                    });

                    // property: property rates
                    Route::group(['prefix' => 'rates'], function () {
                        Route::get('', 'PropertyRatesController@index')->name('property-rates');
                        Route::get('create', 'PropertyRatesController@create')->name('property-rates.create');
                        Route::post('store', 'PropertyRatesController@store')->name('property-rates.store');
                        Route::get('show/{rate}', 'PropertyRatesController@show')->name('property-rates.show');
                        Route::get('edit/{rate}', 'PropertyRatesController@edit')->name('property-rates.edit');
                        Route::post('update/{id}', 'PropertyRatesController@update')->name('property-rates.update');
                        Route::get('destroy/{id}', 'PropertyRatesController@destroy')->name('property-rates.destroy');
                    });

                    // property: property images
                    Route::group(['prefix' => 'images'], function () {
                        Route::get('', 'PropertyImagesController@index')->name('property-images');
                        Route::get('create', 'PropertyImagesController@create')->name('property-images.create');
                        Route::post('store', 'PropertyImagesController@store')->name('property-images.store');
                        Route::get('show/{image}', 'PropertyImagesController@show')->name('property-images.show');
                        Route::get('edit/{image}', 'PropertyImagesController@edit')->name('property-images.edit');
                        Route::post('update/{id}', 'PropertyImagesController@update')->name('property-images.update');
                        Route::get('destroy/{id}', 'PropertyImagesController@destroy')->name('property-images.destroy');

                        Route::get('orderUp/{image}', 'PropertyImagesController@orderUp')->name('property-images.order-up');
                        Route::get('orderDown/{image}', 'PropertyImagesController@orderDown')->name('property-images.order-down');
                    });

                    // property: property management
                    Route::group(['prefix' => 'property-management'], function () {
                        Route::get('', 'PropertyManagementController@index')->name('property-management');
                        Route::get('create', 'PropertyManagementController@create')->name('property-management.create');
                        Route::post('store', 'PropertyManagementController@store')->name('property-management.store');
                        Route::get('show/{pm}', 'PropertyManagementController@show')->name('property-management.show');
                        Route::get('edit/{pm}', 'PropertyManagementController@edit')->name('property-management.edit');
                        Route::post('update/{id}', 'PropertyManagementController@update')->name('property-management.update');
                        Route::get('destroy/{id}', 'PropertyManagementController@destroy')->name('property-management.destroy');
                    });
                    
                });
            });
            
            // all property managements prefix
            Route::group(['prefix' => 'property-management'], function () {

                // all property managements
                Route::group(['middleware' => 'role-permission:properties,property-management'], function () {
                    Route::get('', 'PropertyManagementController@general')->name('property-management.general');
                });

                // all properties balances
                Route::group(['prefix' => 'balances', 'middleware' => 'role-permission:properties,balances'], function () {
                    Route::get('', 'PropertyManagementBalancesController@general')->name('property-management-balances.general');
                });

                // all transactions
                Route::group(['prefix' => 'transactions', 'middleware' => 'role-permission:properties,transactions'], function () {
                    Route::get('', 'PropertyManagementTransactionsController@general')->name('property-management-transactions.general');
                });

                // single property management
                Route::group(['prefix' => '{pm}', 'middleware' => 'role-permission:properties,index'], function () {

                    // single property management balances
                    Route::group(['prefix' => 'balances'], function () {
                        Route::get('', 'PropertyManagementBalancesController@index')->name('property-management-balances');
                    });

                    // single property management transactions
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
        });

        // cleaning-services
        Route::group(['prefix' => 'cleaning-services', 'middleware' => 'role-permission:cleaning-services,index'], function () {
            Route::get('', 'CleaningServicesController@index')->name('cleaning-services');
            Route::get('create', 'CleaningServicesController@create')->name('cleaning-services.create');
            Route::post('store', 'CleaningServicesController@store')->name('cleaning-services.store');
            Route::get('show/{cleaning_service}', 'CleaningServicesController@show')->name('cleaning-services.show');
            Route::get('edit/{cleaning_service}', 'CleaningServicesController@edit')->name('cleaning-services.edit');
            Route::post('update/{id}', 'CleaningServicesController@update')->name('cleaning-services.update');
            Route::get('destroy/{id}', 'CleaningServicesController@destroy')->name('cleaning-services.destroy');
        });

        // contractors
        Route::group(['prefix' => 'contractors', 'middleware' => 'role-permission:contractors,index'], function () {
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

        // human-resources
        Route::group(['prefix' => 'human-resources', 'middleware' => 'role-permission:human-resources,index'], function () {
            Route::get('', 'HumanResourcesController@index')->name('human-resources');
            Route::get('create', 'HumanResourcesController@create')->name('human-resources.create');
            Route::post('store', 'HumanResourcesController@store')->name('human-resources.store');
            Route::get('show/{human_resource}', 'HumanResourcesController@show')->name('human-resources.show');
            Route::get('edit/{human_resource}', 'HumanResourcesController@edit')->name('human-resources.edit');
            Route::post('update/{id}', 'HumanResourcesController@update')->name('human-resources.update');
            Route::get('destroy/{id}', 'HumanResourcesController@destroy')->name('human-resources.destroy');
        });

        // settings
        Route::group(['prefix' => 'settings'], function() {

            Route::get('', 'SettingsController@index')->name('settings');

            // users
            Route::group(['prefix' => 'users'], function () {
                Route::group(['middleware' => 'role-permission:settings,users'], function() {
                    Route::get('', 'UsersController@index')->name('users');
                    Route::get('create', 'UsersController@create')->name('users.create');
                    Route::post('store', 'UsersController@store')->name('users.store');
                    Route::get('show/{user}', 'UsersController@show')->name('users.show');
                    Route::get('edit/{user}', 'UsersController@edit')->name('users.edit');
                    Route::post('update/{id}', 'UsersController@update')->name('users.update');
                    Route::get('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
                });
            });

            // workgroups
            Route::group(['prefix' => 'workgroups'], function () {
                Route::group(['middleware' => 'role-permission:settings,workgroups'], function() {
                    Route::get('', 'WorkgroupsController@index')->name('workgroups');
                    Route::get('create', 'WorkgroupsController@create')->name('workgroups.create');
                    Route::post('store', 'WorkgroupsController@store')->name('workgroups.store');
                    Route::get('show/{workgroup}', 'WorkgroupsController@show')->name('workgroups.show');
                    Route::get('edit/{workgroup}', 'WorkgroupsController@edit')->name('workgroups.edit');
                    Route::post('update/{id}', 'WorkgroupsController@update')->name('workgroups.update');
                    Route::get('destroy/{id}', 'WorkgroupsController@destroy')->name('workgroups.destroy');

                    // single workgroup
                    Route::group(['prefix' => '{workgroup}'], function () {

                        // workgroup users
                        Route::group(['prefix' => 'users'], function() {
                            Route::get('', 'WorkgroupUsersController@index')->name('workgroup-users');
                            Route::get('create', 'WorkgroupUsersController@create')->name('workgroup-users.create');
                            Route::post('store', 'WorkgroupUsersController@store')->name('workgroup-users.store');
                            Route::get('show/{workgroupUser}', 'WorkgroupUsersController@show')->name('workgroup-users.show');
                            Route::get('edit/{workgroupUser}', 'WorkgroupUsersController@edit')->name('workgroup-users.edit');
                            Route::post('update/{id}', 'WorkgroupUsersController@update')->name('workgroup-users.update');
                            Route::get('destroy/{id}', 'WorkgroupUsersController@destroy')->name('workgroup-users.destroy');
                        });

                    });
                });
            });

            // roles
            Route::group(['prefix' => 'roles'], function () {
                Route::group(['middleware' => 'role-permission:settings,roles'], function() {
                    Route::get('', 'RolesController@index')->name('roles');
                });    
                Route::get('set-active/{id}', 'RolesController@setActive')->name('roles.set-active');
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

            // contacts
            Route::group(['prefix' => 'contacts', 'middleware' => 'role-permission:settings,contacts'], function () {
                Route::get('', 'ContactsController@index')->name('contacts');
                Route::get('create', 'ContactsController@create')->name('contacts.create');
                Route::post('store', 'ContactsController@store')->name('contacts.store');
                Route::get('show/{contact}', 'ContactsController@show')->name('contacts.show');
                Route::get('edit/{contact}', 'ContactsController@edit')->name('contacts.edit');
                Route::post('update/{id}', 'ContactsController@update')->name('contacts.update');
                Route::get('destroy/{id}', 'ContactsController@destroy')->name('contacts.destroy');
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

        });

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

    });

    // public routes here
    Route::get('', '_Public\PagesController@home')->name('public.home');

});
