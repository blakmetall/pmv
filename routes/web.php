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

    // properties
    Route::group(['prefix' => 'properties'], function () {
        Route::get('all', 'PropertiesController@index')->name('properties-all');
        Route::post('store', 'PropertiesController@store')->name('properties-store');
        Route::post('create', 'PropertiesController@create')->name('properties-create');
        Route::get('show/{id}', 'PropertiesController@show')->name('properties-show');
        Route::get('update/{id}', 'PropertiesController@edit')->name('properties-edit');
        Route::get('destroy/{id}', 'PropertiesController@destroy')->name('properties-destroy');

        Route::group(['prefix' => 'types'], function () {
            Route::get('all', 'PropertyTypesController@index')->name('types-all');
            Route::post('store', 'PropertyTypesController@store')->name('types-store');
            Route::post('create', 'PropertyTypesController@create')->name('types-create');
            Route::get('show/{id}', 'PropertyTypesController@show')->name('types-show');
            Route::get('update/{id}', 'PropertyTypesController@edit')->name('types-edit');
            Route::get('destroy/{id}', 'PropertyTypesController@destroy')->name('types-destroy');

        });
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
    Route::group(['prefix' => 'amenities'], function () {
        Route::get('', 'AmenitiesController@index')->name('amenities');
        Route::get('create', 'AmenitiesController@create')->name('amenities.create');
        Route::post('store', 'AmenitiesController@store')->name('amenities.store');
        Route::get('show/{amenity}', 'AmenitiesController@show')->name('amenities.show');
        Route::get('edit/{amenity}', 'AmenitiesController@edit')->name('amenities.edit');
        Route::post('update/{id}', 'AmenitiesController@update')->name('amenities.update');
        Route::get('destroy/{id}', 'AmenitiesController@destroy')->name('amenities.destroy');
    });


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

    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);

});

