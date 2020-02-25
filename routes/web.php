<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['web']], function () {

    // auth laravel routes
    Auth::routes(['register' => false]); // public register disabled for this app

    // dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // users
    Route::group(['prefix' => 'users'], function () {
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
        Route::get('', 'RolesController@index')->name('roles');

        // we wont be creating or updating roles, we can delete unnecesary functions and methods
        Route::get('create', 'RolesController@create')->name('roles.create');
        Route::post('store', 'RolesController@store')->name('roles.store');
        Route::get('show/{role}', 'RolesController@show')->name('roles.show');
        Route::get('edit/{role}', 'RolesController@edit')->name('roles.edit');
        Route::post('update/{id}', 'RolesController@update')->name('roles.update');
        Route::get('destroy/{id}', 'RolesController@destroy')->name('roles.destroy');

        // update new active role for user
        Route::get('update-active/{id}', 'RolesController@updateActive')->name('roles.update-active');
    });

    // profile
    Route::group(['prefix' => 'profile'], function () {
        Route::get('create', 'ProfileController@create')->name('profiles.create');
        Route::post('store', 'ProfileController@store')->name('profiles.store');
        Route::get('edit/{id}', 'ProfileController@edit')->name('profiles.edit');
        Route::post('update/{id}', 'ProfileController@update')->name('profiles.update');
    });

    // properties
    Route::group(['prefix' => 'properties', 'middleware' => 'role-permission:settings,amenities'], function () {
        Route::get('', 'PropertiesController@index')->name('properties');
        Route::post('store', 'PropertiesController@store')->name('properties.store');
        Route::get('create', 'PropertiesController@create')->name('properties.create');
        Route::get('show/{property}', 'PropertiesController@show')->name('properties.show');
        Route::get('edit/{property}', 'PropertiesController@edit')->name('properties.edit');
        Route::post('update/{id}', 'PropertiesController@update')->name('properties.update');
        Route::get('destroy/{id}', 'PropertiesController@destroy')->name('properties.destroy');
    });

    // zones
    Route::group(['prefix' => 'zones'], function () {
        Route::get('', 'ZonesController@index')->name('zones');
        Route::get('create', 'ZonesController@create')->name('zones.create');
        Route::post('store', 'ZonesController@store')->name('zones.store');
        Route::get('show/{zone}', 'ZonesController@show')->name('zones.show');
        Route::get('edit/{zone}', 'ZonesController@edit')->name('zones.edit');
        Route::post('update/{id}', 'ZonesController@update')->name('zones.update');
        Route::get('destroy/{id}', 'ZonesController@destroy')->name('zones.destroy');
    });

    // amenities
    Route::group(
        ['prefix' => 'amenities', 'middleware' => 'role-permission:settings,amenities'], 
        function () {
            Route::get('', 'AmenitiesController@index')->name('amenities');
            Route::get('create', 'AmenitiesController@create')->name('amenities.create');
            Route::post('store', 'AmenitiesController@store')->name('amenities.store');
            Route::get('show/{amenity}', 'AmenitiesController@show')->name('amenities.show');
            Route::get('edit/{amenity}', 'AmenitiesController@edit')->name('amenities.edit');
            Route::post('update/{id}', 'AmenitiesController@update')->name('amenities.update');
            Route::get('destroy/{id}', 'AmenitiesController@destroy')->name('amenities.destroy');
        }
    );


    // transaction types
    Route::group(['prefix' => 'transaction-types'], function () {
        Route::get('', 'TransactionTypesController@index')->name('transaction-types');
        Route::get('create', 'TransactionTypesController@create')->name('transaction-types.create');
        Route::post('store', 'TransactionTypesController@store')->name('transaction-types.store');
        Route::get('show/{transaction_type}', 'TransactionTypesController@show')->name('transaction-types.show');
        Route::get('edit/{transaction_type}', 'TransactionTypesController@edit')->name('transaction-types.edit');
        Route::post('update/{id}', 'TransactionTypesController@update')->name('transaction-types.update');
        Route::get('destroy/{id}', 'TransactionTypesController@destroy')->name('transaction-types.destroy');
    });

    // language 
    Route::group(['prefix' => 'language'], function () {
        Route::get('update/{locale}', 'LanguageController@update')->name('language.update');
    });

    // error pages
    Route::group(['prefix' => 'error'], function() {
        Route::get('forbidden', 'ErrorController@forbidden')->name('error.forbidden');
        Route::get('not-found', 'ErrorController@notFound')->name('error.not-found');
    });
});

