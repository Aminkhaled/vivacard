<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace'   =>  'ApiV001'], function () {


    // initial Routes
    Route::get('initial', ['as' => 'initial', 'uses' => 'BaseController@initial']);
    Route::get('infos', ['as' => 'infos', 'uses' => 'BaseController@infos']);
    Route::get('contacts', ['as' => 'contacts', 'uses' => 'BaseController@contacts']);
    Route::get('citiesAndSpecialties', ['as' => 'citiesAndSpecialties', 'uses' => 'BaseController@citiesAndSpecialties']);
    Route::get('advertisements', ['as' => 'advertisements', 'uses' => 'BaseController@advertisements']);
    Route::get('packages', ['as' => 'packages', 'uses' => 'BaseController@packages']);

    Route::post('postContact', ['as' => 'postContact', 'uses' => 'BaseController@postContact']);

    Route::get('diseasesTypes', ['as' => 'diseasesTypes', 'uses' => 'BaseController@diseasesTypes']);
    Route::get('diseases', ['as' => 'diseases', 'uses' => 'BaseController@diseases']);
    Route::get('diseases/details', ['as' => 'disease', 'uses' => 'BaseController@disease']);

    // Auth Routes for customers
    Route::get('sendVerifyCode', ['as' => 'sendVerifyCode', 'uses' => 'CustomersController@sendVerifyCode']);
    Route::get('checkVerifyCode', ['as' => 'checkVerifyCode', 'uses' => 'CustomersController@checkVerifyCode']);
    Route::get('checkPhoneNumber', ['as' => 'checkPhoneNumber', 'uses' => 'CustomersController@checkPhoneNumber']);
    Route::get('checkEmailExist', ['as' => 'checkEmailExist', 'uses' => 'CustomersController@checkEmailExist']);
    Route::post('register', ['as' => 'register', 'uses' => 'CustomersController@register']);
    Route::post('login', ['as' => 'login', 'uses' => 'CustomersController@login']);
    Route::post('forgotPassword', ['as' => 'forgotPassword', 'uses' => 'CustomersController@forgotPassword']);
    Route::post('forgotPasswordMobile', ['as' => 'forgotPasswordMobile', 'uses' => 'CustomersController@forgotPasswordMobile']);
    Route::post('forgotPasswordEmail', ['as' => 'forgotPasswordEmail', 'uses' => 'CustomersController@forgotPasswordEmail']);

    Route::group(['middleware' => 'auth:customer'], function () {

        Route::post('logout', ['as' => 'logout', 'uses' => 'CustomersController@logout']);

        // Customer Routes
        Route::post('changePassword', ['as' => 'changePassword', 'uses' => 'CustomersController@changePassword']);
        Route::post('customerUpdate', ['as' => 'customerUpdate', 'uses' => 'CustomersController@customerUpdate']);
        Route::get('customerData', ['as' => 'customerData', 'uses' => 'CustomersController@customerData']);

        Route::get('getCustomerNotification', ['as' => 'getCustomerNotification', 'uses' => 'CustomersController@getCustomerNotification']);
        Route::get('readCustomerNotification/{notifications_id}', ['as' => 'readCustomerNotification', 'uses' => 'CustomersController@readCustomerNotification']);
        Route::get('readAllCustomerNotification', ['as' => 'readAllCustomerNotification', 'uses' => 'CustomersController@readAllCustomerNotification']);

        Route::get('getFreeTrial', ['as' => 'getFreeTrial', 'uses' => 'BaseController@getFreeTrial']);
        Route::post('subscriptionPackage', ['as' => 'subscriptionPackage', 'uses' => 'BaseController@subscriptionPackage']);

    });

});
