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

Route::prefix('main')->group(function() {
    Route::get('/', 'MainController@index');
});

Route::prefix('admin')
->name('admin.')->namespace('Admin')
->group(function () {

    Route::middleware(['auth:admin', 'check_permission','check_user_status'])->group(function() {

	    /**
		 * Countries Routes
		 */
	    Route::resource('countries', 'CountriesController');
        Route::get('countries/changeStatus/{id}/{status}', 'CountriesController@changeStatus')->name('countries.changeStatus');

		/**
		 * Stores Routes
		 */
	    Route::resource('stores', 'StoresController');
        Route::get('stores/changeStatus/{id}/{status}', 'StoresController@changeStatus')->name('stores.changeStatus');

		/**
		 * Offers Routes
		 */
	    Route::resource('offers', 'OffersController');
        Route::get('offers/changeStatus/{id}/{status}', 'OffersController@changeStatus')->name('offers.changeStatus');

		/**
		 * Categories Routes
		 */
	    Route::resource('categories', 'CategoriesController');
        Route::get('categories/changeStatus/{id}/{status}', 'CategoriesController@changeStatus')->name('categories.changeStatus');
		Route::post('categories/import', 'CategoriesController@import')->name('categories.import');
        Route::get('categories/export/excel', 'CategoriesController@export')->name('categories.export');

        /**
		 * Coupons Routes
		 */
	    Route::resource('coupons', 'CouponsController');
        Route::get('coupons/changeStatus/{id}/{status}', 'CouponsController@changeStatus')->name('coupons.changeStatus');
		Route::post('coupons/import', 'CouponsController@import')->name('coupons.import');
        Route::get('coupons/export/excel', 'CouponsController@export')->name('coupons.export');

        /**
		 * customers Routes
		 */
	    Route::resource('customers', 'CustomersController')->except(['create', 'store']);
        Route::get('customers/changeStatus/{id}/{status}', 'CustomersController@changeStatus')->name('customers.changeStatus');


        /**
		 * DailyOffers Routes
		 */
	    Route::resource('daily_offers', 'DailyOffersController');
        Route::get('daily_offers/changeStatus/{id}/{status}', 'DailyOffersController@changeStatus')->name('daily_offers.changeStatus');
		Route::post('daily_offers/import', 'DailyOffersController@import')->name('daily_offers.import');
        Route::get('daily_offers/export/excel', 'DailyOffersController@export')->name('daily_offers.export');

        /**
		 * Cities Routes
		 */
	    // Route::resource('cities', 'CitiesController')->except([ 'create', 'store', 'edit', 'update', 'destroy' ]);
        // Route::get('cities/changeStatus/{id}/{status}', 'CitiesController@changeStatus')->name('cities.changeStatus');

		/**
		 * articles_categories Routes
		 */
        Route::resource('articles_categories', 'ArticlesCategoriesController');
        Route::get('articles_categories/changeStatus/{id}/{status}', 'ArticlesCategoriesController@changeStatus')->name('articles_categories.changeStatus');

        /**
		 * articles Routes
		 */
        Route::resource('articles', 'ArticlesController');
        // Route::post('articles/uploadImage', 'ArticlesController@uploadImage')->name('articles.uploadImage');
        // Route::post('articles/deleteImage', 'ArticlesController@deleteImage')->name('articles.deleteImage');
        Route::get('articles/changeStatus/{id}/{status}', 'ArticlesController@changeStatus')->name('articles.changeStatus');


    });
});
