<?php

Route::group(['middleware' => ['web']], function () {
    // auth laravel routes
    Auth::routes(['register' => false]); // public register disabled for this app

    // language
    Route::group(['prefix' => 'language'], function () {
        Route::get('update/{locale}/{property?}', 'LanguageController@update')->name('language.update');
    });

    // error pages
    Route::group(['prefix' => 'error'], function () {
        Route::get('forbidden', 'ErrorController@forbidden')->name('error.forbidden');
        Route::get('not-found', 'ErrorController@notFound')->name('error.not-found');
    });

    // auth middleware
    Route::group(['prefix' => 'system', 'middleware' => 'auth'], function () {
        //maintenance
        // Route::get('maintenance', 'DashboardController@maintenance')->name('maintenance');

        // dashboard
        Route::get('', 'DashboardController@index');
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        // dashboard: general search
        Route::group(['middleware' => 'role-permission:dashboard,general-search'], function () {
            Route::get('dashboard/general-search', 'DashboardController@generalSearch')->name('dashboard.general-search');
        });

        // calendar
        Route::group(['prefix' => 'calendar', 'middleware' => 'role-permission:calendar,index'], function () {
            Route::get('', 'CalendarController@index')->name('calendar');
        });

        // bookings prefix
        Route::group(['prefix' => 'property-bookings'], function () {
            // all bookings
            Route::group(['middleware' => 'role-permission:property-bookings,index'], function () {
                Route::get('', 'PropertyBookingController@index')->name('property-bookings');
                Route::get('arrivals-departures', 'PropertyBookingController@arrivalsDepartures')->name('property-bookings.arrivals-departures');
                Route::get('general-availability', 'PropertyBookingController@generalAvailability')->name('property-bookings.general-availability');
                Route::get('rates-calculator', 'PropertyBookingController@ratesCalculator')->name('property-bookings.rates-calculator');
                Route::get('create/{property}', 'PropertyBookingController@create')->name('property-bookings.create');
                Route::post('store', 'PropertyBookingController@store')->name('property-bookings.store');
                Route::get('show/{id}', 'PropertyBookingController@show')->name('property-bookings.show');
                Route::get('edit/{id}', 'PropertyBookingController@edit')->name('property-bookings.edit');
                Route::post('update/{id}', 'PropertyBookingController@update')->name('property-bookings.update');
                Route::get('destroy/{id}', 'PropertyBookingController@destroy')->name('property-bookings.destroy');
            });

            Route::group(['prefix' => 'property-booking-payments'], function () {
                // all payments
                Route::group(['middleware' => 'role-permission:property-bookings,index'], function () {
                    Route::get('/{booking}', 'PropertyBookingPaymentsController@index')->name('property-booking-payments');
                    Route::get('create/{booking}', 'PropertyBookingPaymentsController@create')->name('property-booking-payments.create');
                    Route::post('store', 'PropertyBookingPaymentsController@store')->name('property-booking-payments.store');
                    Route::get('show/{id}', 'PropertyBookingPaymentsController@show')->name('property-booking-payments.show');
                    Route::get('edit/{id}', 'PropertyBookingPaymentsController@edit')->name('property-booking-payments.edit');
                    Route::get('email/{id}', 'PropertyBookingPaymentsController@email')->name('property-booking-payments.email');
                    Route::post('send-email/{booking}', 'PropertyBookingPaymentsController@sendEmail')->name('property-booking-payments.send-email');
                    Route::post('generate-img', 'PropertyBookingPaymentsController@generateImagePayment')->name('property-booking-payments.generate-img');
                    Route::post('update/{id}', 'PropertyBookingPaymentsController@update')->name('property-booking-payments.update');
                    Route::get('destroy/{id}', 'PropertyBookingPaymentsController@destroy')->name('property-booking-payments.destroy');
                });
            });

            // property selection partial for creating new booking
            Route::get('property-selection', 'PropertyBookingController@getPropertySelection')->name('property-bookings.get-property-selection');
            Route::get('generate-booking-url/{property?}', 'PropertyBookingController@generateBookingUrl')->name('property-bookings.generate-booking-url');
            Route::post('check-availability', 'PropertyBookingController@checkAvailability')->name('property-bookings.check-availability');

            // bookings by property
            Route::group(['middleware' => 'role-permission:property-bookings,property'], function () {
                Route::get('property/{property}', 'PropertyBookingController@propertyBookings')->name('property-bookings.by-property');
            });

            // bookings by owner
            Route::group(['middleware' => 'role-permission:property-bookings,owner'], function () {
                Route::get('owner/{owner}', 'PropertyBookingController@ownerBookings')->name('property-bookings.by-owner');
            });

            // bookings by client user
            Route::group(['middleware' => 'role-permission:property-bookings,client'], function () {
                Route::get('client/{client}', 'PropertyBookingController@clientBookings')->name('property-bookings.by-client');
            });

            // agents
            Route::group(['prefix' => 'agents', 'middleware' => 'role-permission:bookings,agents'], function () {
                Route::get('', 'AgentsController@index')->name('agents');
            });
        });

        // properties prefix
        Route::group(['prefix' => 'properties'], function () {

            // order all images
            Route::post('orderPropertyImages', 'PropertyImagesController@orderAll')->name('property-images.order-all');

            // properties
            Route::group(['middleware' => 'role-permission:properties,index'], function () {
                Route::get('', 'PropertiesController@index')->name('properties');
                Route::get('create', 'PropertiesController@create')->name('properties.create');
                Route::post('store', 'PropertiesController@store')->name('properties.store');
                Route::get('show/{property}', 'PropertiesController@show')->name('properties.show');
                Route::get('getBonus', 'PropertiesController@getBonus')->name('properties.get-bonus');
                Route::get('edit/{property}', 'PropertiesController@edit')->name('properties.edit');
                Route::post('update/{id}', 'PropertiesController@update')->name('properties.update');
                Route::get('destroy/{id}', 'PropertiesController@destroy')->name('properties.destroy');
                Route::get('modal', 'PropertyBookingController@calendarModal')->name('property-calendar.calendar-modal');

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
                    Route::group(['prefix' => 'contacts', 'middleware' => 'role-permission:settings,contacts'], function () {
                        Route::get('', 'PropertyContactsController@index')->name('property-contacts');
                        Route::get('create', 'PropertyContactsController@create')->name('property-contacts.create');
                        Route::post('store', 'PropertyContactsController@store')->name('property-contacts.store');
                    });

                    // property: property calendar
                    Route::group(['prefix' => 'calendar'], function () {
                        Route::get('/{year?}', 'PropertyBookingController@calendar')->name('property-calendar');
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
                        Route::get('destroyAll/{ids?}', 'PropertyImagesController@destroyAll')->name('property-images.destroy-all');

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

                    // property: property check list
                    Route::group(['prefix' => 'property-check-list'], function () {
                        Route::get('', 'PropertyCheckListController@index')->name('property-check-list');
                        Route::get('create', 'PropertyCheckListController@create')->name('property-check-list.create');
                        Route::post('store', 'PropertyCheckListController@store')->name('property-check-list.store');
                        Route::get('show/{checkList}', 'PropertyCheckListController@show')->name('property-check-list.show');
                        Route::get('edit/{checkList}', 'PropertyCheckListController@edit')->name('property-check-list.edit');
                        Route::post('update/{id}', 'PropertyCheckListController@update')->name('property-check-list.update');
                        Route::get('destroy/{id}', 'PropertyCheckListController@destroy')->name('property-check-list.destroy');
                    });
                });
            });
        });

        // all property managements prefix
        Route::group(['prefix' => 'property-management'], function () {
            // all property managements
            Route::group(['middleware' => 'role-permission:property-management,index'], function () {
                Route::get('', 'PropertyManagementController@general')->name('property-management.general');
            });

            // property selection partial for creating new transaction
            Route::get('property-selection', 'PropertyManagementController@getPropertySelection')->name('property-management.get-property-selection');
            Route::get('generate-pm-transaction-url/{property?}', 'PropertyManagementController@generatePMTransactionUrl')->name('property-management.generate-pm-transaction-url');

            // all properties balances
            Route::group(['prefix' => 'balances', 'middleware' => 'role-permission:property-management,balances'], function () {
                Route::get('', 'PropertyManagementBalancesController@general')->name('property-management-balances.general');

                Route::get('confirm-email', 'PropertyManagementBalancesController@confirmEmail')->name('property-management-balances.confirm-email');

                Route::get('email/{pm}', 'PropertyManagementBalancesController@email')->name('property-management-balances.email');
            });

            // all transactions
            Route::group(['prefix' => 'transactions', 'middleware' => 'role-permission:property-management,transactions'], function () {
                Route::get('', 'PropertyManagementTransactionsController@general')->name('property-management-transactions.general');

                // property management transactions bulk events
                Route::get('create-bulk', 'PropertyManagementTransactionsController@createBulk')->name('property-management-transactions.create-bulk');
                Route::post('store-bulk', 'PropertyManagementTransactionsController@storeBulk')->name('property-management-transactions.store-bulk');
                Route::get('generate-pm-transaction-monthly/{property?}/{year}/{month}', 'PropertyManagementTransactionsController@generatePMTransactionMonthly')->name('property-management.generate-pm-transaction-monthly');
            });

            // audit transaction batch
            Route::get('audit-batch/{batch?}', 'PropertyManagementTransactionsController@auditBatch')->name('property-management-transactions.audit-batch');

            // remove audit transaction batch
            Route::get('remove-audit-batch/{batch?}', 'PropertyManagementTransactionsController@removeAuditBatch')->name('property-management-transactions.remove-audit-batch');

            // delete transaction batch
            Route::get('delete-batch/{batch?}', 'PropertyManagementTransactionsController@deleteBatch')->name('property-management-transactions.delete-batch');

            // confirm delete image transaction
            Route::get('confirm-delete-image-transaction', 'PropertyManagementTransactionsController@confirmDeleteImage')->name('property-management-transactions.confirm-delete-image');
            // delete image transaction
            Route::get('delete-image-transaction/{transaction}', 'PropertyManagementTransactionsController@deleteImage')->name('property-management-transactions.delete-image');

            // single property management
            Route::get('confirm-email', 'PropertyManagementTransactionsController@confirmEmail')->name('property-management-transactions.confirm-email');
            Route::group(['prefix' => '{pm}', 'middleware' => 'role-permission:property-management,transactions'], function () {
                // single property management transactions
                Route::group(['prefix' => 'transactions'], function () {
                    Route::get('', 'PropertyManagementTransactionsController@index')->name('property-management-transactions');
                    Route::get('email/{transaction}', 'PropertyManagementTransactionsController@email')->name('property-management-transactions.email');
                    Route::get('create', 'PropertyManagementTransactionsController@create')->name('property-management-transactions.create');
                    Route::post('store', 'PropertyManagementTransactionsController@store')->name('property-management-transactions.store');
                    Route::get('show/{transaction}', 'PropertyManagementTransactionsController@show')->name('property-management-transactions.show');
                    Route::get('edit/{transaction}', 'PropertyManagementTransactionsController@edit')->name('property-management-transactions.edit');
                    Route::get('editAjax/{transaction}', 'PropertyManagementTransactionsController@editAjax')->name('property-management-transactions.edit-ajax');
                    Route::post('update/{id}', 'PropertyManagementTransactionsController@update')->name('property-management-transactions.update');
                    Route::get('destroy/{id}', 'PropertyManagementTransactionsController@destroy')->name('property-management-transactions.destroy');
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
            Route::get('createAjax', 'CleaningServicesController@createAjax')->name('cleaning-services.create-ajax');
            Route::get('editAjax/{cleaning_service}', 'CleaningServicesController@editAjax')->name('cleaning-services.edit-ajax');
            Route::get('destroyAjax/{id}', 'CleaningServicesController@destroyAjax')->name('cleaning-services.destroy-ajax');

            // calendar view
            Route::get('monthly-batch', 'CleaningServicesController@monthlyBatch')->name('cleaning-services.monthly-batch');
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

        // human-resources directory
        Route::group(['prefix' => 'human-resources/directory', 'middleware' => 'role-permission:human-resources,directory'], function () {
            Route::get('directory', 'HumanResourcesController@directory')->name('human-resources.directory');
        });

        // pages
        Route::group(['prefix' => 'pages', 'middleware' => 'role-permission:pages,index'], function () {
            Route::get('', 'PagesController@index')->name('pages');
            Route::get('create', 'PagesController@create')->name('pages.create');
            Route::post('store', 'PagesController@store')->name('pages.store');
            Route::get('show/{page}', 'PagesController@show')->name('pages.show');
            Route::get('edit/{page}', 'PagesController@edit')->name('pages.edit');
            Route::post('update/{id}', 'PagesController@update')->name('pages.update');
            Route::get('destroy/{id}', 'PagesController@destroy')->name('pages.destroy');
        });

        // payment methods
        Route::group(['prefix' => 'payment-methods', 'middleware' => 'role-permission:pages,index'], function () {
            Route::get('', 'PaymentMethodsController@index')->name('payment-methods');
            Route::get('create', 'PaymentMethodsController@create')->name('payment-methods.create');
            Route::post('store', 'PaymentMethodsController@store')->name('payment-methods.store');
            Route::get('show/{paymentMethod}', 'PaymentMethodsController@show')->name('payment-methods.show');
            Route::get('edit/{paymentMethod}', 'PaymentMethodsController@edit')->name('payment-methods.edit');
            Route::post('update/{id}', 'PaymentMethodsController@update')->name('payment-methods.update');
            Route::get('destroy/{id}', 'PaymentMethodsController@destroy')->name('payment-methods.destroy');
        });

        // testimonials
        Route::group(['prefix' => 'testimonials', 'middleware' => 'role-permission:pages,index'], function () {
            Route::get('', 'TestimonialsController@index')->name('testimonials');
            Route::get('create', 'TestimonialsController@create')->name('testimonials.create');
            Route::post('store', 'TestimonialsController@store')->name('testimonials.store');
            Route::get('show/{testimonial}', 'TestimonialsController@show')->name('testimonials.show');
            Route::get('edit/{testimonial}', 'TestimonialsController@edit')->name('testimonials.edit');
            Route::post('update/{id}', 'TestimonialsController@update')->name('testimonials.update');
            Route::get('destroy/{id}', 'TestimonialsController@destroy')->name('testimonials.destroy');
        });

        // agencies
        Route::group(['prefix' => 'agencies', 'middleware' => 'role-permission:pages,index'], function () {
            Route::get('', 'AgenciesController@index')->name('agencies');
            Route::get('create', 'AgenciesController@create')->name('agencies.create');
            Route::post('store', 'AgenciesController@store')->name('agencies.store');
            Route::get('show/{agency}', 'AgenciesController@show')->name('agencies.show');
            Route::get('edit/{agency}', 'AgenciesController@edit')->name('agencies.edit');
            Route::post('update/{id}', 'AgenciesController@update')->name('agencies.update');
            Route::get('destroy/{id}', 'AgenciesController@destroy')->name('agencies.destroy');
        });

        // lgbts
        Route::group(['prefix' => 'lgbts', 'middleware' => 'role-permission:pages,index'], function () {
            Route::get('', 'LgbtsController@index')->name('lgbts');
            Route::get('create', 'LgbtsController@create')->name('lgbts.create');
            Route::post('store', 'LgbtsController@store')->name('lgbts.store');
            Route::get('show/{lgbt}', 'LgbtsController@show')->name('lgbts.show');
            Route::get('edit/{lgbt}', 'LgbtsController@edit')->name('lgbts.edit');
            Route::post('update/{id}', 'LgbtsController@update')->name('lgbts.update');
            Route::get('destroy/{id}', 'LgbtsController@destroy')->name('lgbts.destroy');
        });

        // settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('', 'SettingsController@index')->name('settings');

            // users
            Route::group(['prefix' => 'users'], function () {
                Route::group(['middleware' => 'role-permission:settings,users'], function () {
                    Route::get('', 'UsersController@index')->name('users');
                    Route::get('create', 'UsersController@create')->name('users.create');
                    Route::post('store', 'UsersController@store')->name('users.store');
                    Route::post('storeAjax', 'UsersController@storeAjax')->name('users.store-ajax');
                    Route::get('email/{user}', 'UsersController@email')->name('users.email');
                    Route::get('show/{user}', 'UsersController@show')->name('users.show');
                    Route::get('edit/{user}', 'UsersController@edit')->name('users.edit');
                    Route::post('update/{id}', 'UsersController@update')->name('users.update');
                    Route::get('destroy/{id}', 'UsersController@destroy')->name('users.destroy');
                    Route::get('createAjax', 'UsersController@createAjax')->name('users.create-ajax');
                });
            });

            // workgroups
            Route::group(['prefix' => 'workgroups'], function () {
                Route::group(['middleware' => 'role-permission:settings,workgroups'], function () {
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
                        Route::group(['prefix' => 'users'], function () {
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
                Route::group(['middleware' => 'role-permission:settings,roles'], function () {
                    Route::get('', 'RolesController@index')->name('roles');
                    // Route::get('sections-permissions/{role}', 'RolesSectionsPermissionsController@index')->name('roles.sections-permissions');
                    // Route::post('sections-permissions/save', 'RolesSectionsPermissionsController@save')->name('roles.sections-permissions.save');
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

            // offices
            Route::group(['prefix' => 'offices', 'middleware' => 'role-permission:settings,offices'], function () {
                Route::get('', 'OfficesController@index')->name('offices');
                Route::get('create', 'OfficesController@create')->name('offices.create');
                Route::post('store', 'OfficesController@store')->name('offices.store');
                Route::get('show/{office}', 'OfficesController@show')->name('offices.show');
                Route::get('edit/{office}', 'OfficesController@edit')->name('offices.edit');
                Route::post('update/{id}', 'OfficesController@update')->name('offices.update');
                Route::get('destroy/{id}', 'OfficesController@destroy')->name('offices.destroy');
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

            // necesario fuera para obtener listado para lectura sin requerir permisos
            Route::get('zones/list/{city}', 'ZonesController@list')->name('zones.list');

            // buildings
            Route::group(['prefix' => 'buildings', 'middleware' => 'role-permission:settings,buildings'], function () {
                Route::get('', 'BuildingsController@index')->name('buildings');
                Route::get('create', 'BuildingsController@create')->name('buildings.create');
                Route::post('store', 'BuildingsController@store')->name('buildings.store');
                Route::get('show/{building}', 'BuildingsController@show')->name('buildings.show');
                Route::get('edit/{building}', 'BuildingsController@edit')->name('buildings.edit');
                Route::post('update/{id}', 'BuildingsController@update')->name('buildings.update');
                Route::get('destroy/{id}', 'BuildingsController@destroy')->name('buildings.destroy');
            });

            // contacts
            Route::group(['prefix' => 'contacts', 'middleware' => 'role-permission:settings,contacts'], function () {
                Route::get('', 'ContactsController@index')->name('contacts');
                Route::get('create', 'ContactsController@create')->name('contacts.create');
                Route::post('store', 'ContactsController@store')->name('contacts.store');
                Route::get('show/{contact}', 'ContactsController@show')->name('contacts.show');
                Route::get('edit/{contact}', 'ContactsController@edit')->name('contacts.edit');
                Route::get('createAjax', 'ContactsController@createAjax')->name('contacts.create-ajax');
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

    //********* PUBLIC ROUTES *********//

    // Home (Coming soon)
    Route::get('', '_Public\HomeController@init');

    Route::get('property/zones/{city}', '_Public\PropertyController@zones');

    // auth middleware
    Route::group(['prefix' => '{locale?}'], function () {
        Route::get('', '_Public\HomeController@default')->name('public.home-default');

        // Properties
        Route::get('property/zones/{city}', '_Public\PropertyController@zones')->name('public.zones.list');
        Route::get('property/{zone}/{slug}', '_Public\PropertyController@propertyDetail')->name('public.property-detail');
        Route::get('availability-results', '_Public\PropertyController@availabilityResults')->name('public.availability-results');
        Route::get('modal-availability', '_Public\PropertyController@availabilityModal')->name('public.availability-modal');
        Route::get('first-availability', '_Public\PropertyController@firstsAvailability')->name('public.first-availability');
        Route::get('reservations/{id}', '_Public\PropertyController@reservations')->name('public.reservations');
        Route::post('make-reservation', '_Public\PropertyController@makeReservation')->name('public.make-reservation');
        Route::get('thank-you/{booking}', '_Public\PropertyController@thankYou')->name('public.thank-you');

        // Vacation Services
        Route::get('vacation-services', '_Public\VacationServicesController@index')->name('public.vacation-services');
        Route::get('make-payment/{booking?}', '_Public\VacationServicesController@searchBooking')->name('public.vacation-services.make-payment');
        Route::post('find-booking', '_Public\VacationServicesController@findBooking')->name('public.vacation-services.find-booking');
        Route::get('make-payment-verify/{booking}', '_Public\VacationServicesController@resultsBookings')->name('public.vacation-services.make-payment-verify');
        Route::get('thank-you', '_Public\VacationServicesController@thankYou')->name('public.vacation-services.thank-you');
        Route::get('payment-methods', '_Public\VacationServicesController@paymentMethods')->name('public.vacation-services.payment-methods');
        Route::get('rental-agreement', '_Public\VacationServicesController@rentalAgreement')->name('public.vacation-services.rental-agreement');
        Route::get('accidental-rental-damage-insurance', '_Public\VacationServicesController@damageInsurance')->name('public.vacation-services.accidental-rental-damage-insurance');

        // Concierge Services
        Route::get('concierge-services', '_Public\ConciergeServicesController@index')->name('public.concierge-services');
        Route::get('helpful-information', '_Public\ConciergeServicesController@helpfulInformation')->name('public.concierge-services.helpful-information');

        // Property Management
        Route::get('property-management', '_Public\PropertyManagementController@index')->name('public.property-management');

        // About
        Route::get('about-palmera-vacations', '_Public\AboutController@index')->name('public.about');
        Route::get('puerto-vallarta-history', '_Public\AboutController@puertoVallarta')->name('public.about.puerto-vallarta-history');
        Route::get('nuevo-vallarta-history', '_Public\AboutController@nuevoVallarta')->name('public.about.nuevo-vallarta-history');
        Route::get('mazatlan-history', '_Public\AboutController@mazatlanVallarta')->name('public.about.mazatlan-history');
        Route::get('testimonials', '_Public\AboutController@testimonials')->name('public.about.testimonials');
        Route::get('testimonial/{id}', '_Public\AboutController@testimonialDetail')->name('public.about.testimonial');
        Route::get('privacy-policy', '_Public\AboutController@privacyPolicy')->name('public.about.privacy-policy');
        Route::get('terms-of-use', '_Public\AboutController@termsOfUse')->name('public.about.terms-of-use');
        Route::get('real-estate-business-directory', '_Public\AboutController@realEstateBusinessDirectory')->name('public.about.real-estate-business-directory');
        Route::get('real-estate-business-directory/{id}', '_Public\AboutController@agencyDetail')->name('public.about.real-estate-business-directory-detail');
        Route::get('lgbt-business-directory', '_Public\AboutController@lgbtBusinessDirectory')->name('public.about.lgbt-business-directory');
        Route::get('lgbt-business-directory/{id}', '_Public\AboutController@lgbtDetail')->name('public.about.lgbt-business-directory-detail');

        // Contact
        Route::get('contact', '_Public\ContactController@index')->name('public.contact');
        Route::post('contact/send-email', '_Public\ContactController@sendEmail')->name('public.contact.send-email');
    });
});
