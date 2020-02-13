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

    // Rutas de propiedades
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

// Rutas de Zonas
    Route::group(['prefix' => 'zones'], function () {
        Route::get('all', 'ZonesController@index')->name('zones-all');
        Route::post('store', 'ZonesController@store')->name('zones-store');
        Route::get('create', 'ZonesController@create')->name('zones-create');
        Route::get('show/{id}', 'ZonesController@show')->name('zones-show');
        Route::get('update/{id}', 'ZonesController@edit')->name('zones-edit');
        Route::get('destroy/{id}', 'ZonesController@destroy')->name('zones-destroy');
    });

    // amenities routes
    Route::group(['prefix' => 'amenities'], function () {
        Route::get('', 'AmenitiesController@index')->name('amenities');
        Route::get('create', 'AmenitiesController@create')->name('amenities.create');
        Route::post('store', 'AmenitiesController@store')->name('amenities.store');
        Route::get('show/{amenity}', 'AmenitiesController@show')->name('amenities.show');
        Route::get('edit/{amenity}', 'AmenitiesController@edit')->name('amenities.edit');
        Route::post('update/{id}', 'AmenitiesController@update')->name('amenities.update');
        Route::get('destroy/{id}', 'AmenitiesController@destroy')->name('amenities.destroy');
    });

    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);

});

