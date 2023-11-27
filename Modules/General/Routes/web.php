<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::prefix('admin')
->name('admin.')->namespace('Admin')
->group(function () {
	/**
	 * Auth Routes
	 */
    Route::get('login', 'AuthController@getLogin')->name('auth.getLogin')->middleware('guest:admin');
    Route::post('login', 'AuthController@postLogin')->name('auth.postLogin');

    Route::middleware(['auth:admin', 'check_permission','check_user_status'])->group(function() {

		/**
		 * Auth Routes
		 */
	    Route::get('logout', 'AuthController@logout')->name('auth.logout');

		/**
		 * Dashboard Routes
		 */
	    Route::get('/', 'DashboardController@home')->name('dashboard.home');
		Route::post('updateDashboard/{type}', 'DashboardController@updateDashboard')->name('dashboard.updateDashboard');


	    // this sort based on Website Menu in Navbar

	    /**
		 * SpecialScreens Routes
		 */
	    Route::resource('infos', 'InfosController')->except([ 'create', 'store', 'destroy' ]);
	    Route::resource('special_screens', 'SpecialScreensController')->except([ 'create', 'store', 'destroy' ]);

	    /**
		 * ContactUs Routes
		 */
	    Route::resource('contactus', 'ContactUsController')->except([ 'create', 'store']);
	    Route::resource('contacts', 'ContactsController')->except([ 'create', 'store', 'destroy' ]);

	    /**
		 * Admins Routes
		 */
	    Route::resource('admins', 'AdminsController');

	    /**
		 * Roles/Permissions Routes
		 */
	    Route::resource('roles', 'RolesController');
	    Route::get('permissions/update', 'RolesController@updatePermissions')->name('permissions.update');

	    /**
		 * Settings Routes
		 */
	    // Route::resource('settings', 'SettingsController')->except([ 'create', 'store', 'destroy' ]);
	    Route::get('settings', 'SettingsController@index')->name('settings.index');
	    Route::get('settings/edit', 'SettingsController@edit')->name('settings.edit');
	    Route::post('settings/update', 'SettingsController@update')->name('settings.update');

        Route::get('settings/changeLang', 'LocaleFileController@changeLang')->name('settings.changeLang');
        Route::post('settings/saveChangeLang', 'LocaleFileController@saveChangeLang')->name('settings.saveChangeLang');

         /**
		 * Advertisements Routes
		 */
	    Route::resource('advertisements', 'AdvertisementsController');
        Route::post('advertisements/uploadImage', 'AdvertisementsController@uploadImage')->name('advertisements.uploadImage');
        Route::post('advertisements/deleteImage', 'AdvertisementsController@deleteImage')->name('advertisements.deleteImage');
        Route::get('advertisements/changeStatus/{id}/{status}', 'AdvertisementsController@changeStatus')->name('advertisements.changeStatus');

		/**
		 * Faqs Routes
		 */
	    Route::resource('faqs', 'FaqsController');

    });
});
