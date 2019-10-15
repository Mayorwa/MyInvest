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

Route::group(['namespace' => 'Admin', 'prefix' => '{slug}/dashboard'], function() {
    Route::get('/', 'PageController@index');
    Route::get('/users', 'PageController@users');
    Route::get('/companies', 'PageController@companies');
    Route::get('/estates', 'PageController@estates');
    Route::get('/transactions', 'PageController@transactions');
    Route::get('/properties', 'PageController@properties');
    Route::get('/premium', 'PageController@premium');
});

//Estate
Route::group(['namespace' => 'Admin'], function (){
    Route::group(['prefix' => 'estate'],function (){
        Route::post('/create', 'LoadController@createEstate');
    });

    Route::group(['prefix' => '{slug}/dashboard/estates'],function () {
        Route::get('/delete', 'LoadController@deleteEstate');
        Route::get('/{islug}', 'PageController@estate');
    });
});

Route::group(['namespace' => 'Admin'], function (){
    Route::group(['prefix' => 'premium'],function (){
        Route::post('/create', 'LoadController@createPremium');
    });

    Route::group(['prefix' => '{slug}/dashboard/premiums'],function () {
        Route::get('/delete', 'LoadController@deletePremium');
        Route::get('/{islug}', 'PageController@premiumOne');
    });
});

//Properties
Route::group(['namespace' => 'Admin'], function (){
    Route::group(['prefix' => 'property'],function (){
        Route::post('/create', 'LoadController@createProperty');
    });

    Route::group(['prefix' => '{slug}/dashboard/properties'],function () {
        Route::get('/delete', 'LoadController@deleteProperty');
        Route::get('/{islug}', 'PageController@property');
    });
});

//User
Route::group(['namespace' => 'Admin'], function (){
    Route::group(['prefix' => '{slug}/dashboard/users'],function () {
        Route::get('/{islug}', 'PageController@user');
    });
});

//Transaction
Route::group(['namespace' => 'Admin'], function (){
    Route::group(['prefix' => '{slug}/dashboard/transactions'],function () {
        Route::get('/{islug}', 'PageController@transaction');
    });
});


//Company
Route::group(['namespace' => 'Admin'], function (){
    Route::group(['prefix' => '{slug}/dashboard/companies'],function () {
        Route::get('/{islug}', 'PageController@company');
    });
});
