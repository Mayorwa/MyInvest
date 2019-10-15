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

Route::get('/home', function () {
    return view('welcome');
});

//Auth::routes();
Route::get('auth/logout', 'Auth\LoadController@logout');

Route::group(['namespace' => 'Statics'], function() {
        Route::get('terms-and-conditions', 'PageController@terms');
        Route::get('listings', 'PageController@listings');
        Route::get('premium/{slug}', 'PageController@premium');
        Route::get('listing/{slug}', 'PageController@listing');
        Route::get('/', 'PageController@home');
        Route::get('/contact-us', 'PageController@contact');
        Route::get('/investment-flow', 'PageController@investment');
        Route::post('/contact', 'PageController@submitForm');
    });


Route::post('auth/confirm-access', 'Auth\LoadController@useSignUpCode');

Route::get('verification/{code}', 'Auth\LoadController@verifyCode');

Route::post('user/changePassword', 'User\LoadController@changePassword');

Route::post('transaction/startTrnx', 'Transaction\LoadController@startTrxn');

Route::post('transaction/makePayment', 'Transaction\LoadController@makePayment');

Route::get('transaction/complete', 'Transaction\LoadController@confirmPayment');

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::get('login', 'PageController@SignInPage')->name('login');
        Route::get('get-access', 'PageController@getAccess');
        Route::post('get-access', 'LoadController@sendWithCode');
        Route::get('agency', 'PageController@agencyRegister');
    });
        Route::post('signIn', 'LoadController@signIn');
        Route::post('signUp', 'LoadController@signUp');
});

Route::group(['namespace' => 'Company', 'middleware' => 'guest'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::get('register', 'PageController@register');
        Route::post('csignUp', 'LoadController@signUp');
    });
});

Route::group(['namespace' => 'Agency', 'middleware' => 'guest'], function() {
    Route::group(['prefix' => 'auth'], function() {
        Route::post('asignUp', 'LoadController@signUp');
    });
});

Route::group(['namespace' => 'Company', 'prefix' => 'company', 'middleware' => 'Company'], function() {
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', 'PageController@overview')->name('dash');
        Route::get('profile', 'PageController@profile');
        Route::get('settings', 'PageController@settings');
        Route::get('transaction', 'PageController@transaction');
        Route::get('estates', 'PageController@estate');
        Route::get('estates/{slug}', 'PageController@Oneestate');
    });
    Route::post('editInfo', 'LoadController@editInfo');
});

Route::group(['namespace' => 'User', 'prefix' => 'user', 'middleware' => 'User'], function() {
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', 'PageController@overview')->name('dash');
        Route::get('profile', 'PageController@profile');
        Route::get('settings', 'PageController@settings');
        Route::get('cart', 'PageController@cart');
        Route::get('transaction', 'PageController@transaction');
        Route::get('transaction/{slug}', 'PageController@singleTrnx');
    });
    Route::post('editInfo', 'LoadController@editInfo');
});

Route::group(['namespace' => 'Agency', 'prefix' => 'agency', 'middleware' => 'Agency'], function() {
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', 'PageController@overview');
        Route::get('profile', 'PageController@profile');
        Route::get('settings', 'PageController@settings');
        Route::get('transaction', 'PageController@transaction');
    });
    Route::post('editInfo', 'LoadController@editInfo');
});

Route::get('register', 'PageController@companyReg');

Route::group(['namespace' => 'User', 'middleware' => 'auth', 'prefix' => 'dashboard'],function (){
});
