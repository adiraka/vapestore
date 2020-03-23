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

Route::get('/', function () {
    return 'Home Page';
});

Route::prefix('admin')->group(function() {
    Route::middleware(['guest'])->group(function() {
        Route::get('login', 'Admin\AuthController@getLoginPage')->name('admin.getLogin');
        Route::post('login', 'Admin\AuthController@postLogin')->name('admin.postLogin');
    });

    Route::middleware(['auth'])->group(function() {
        Route::get('dashboard', 'Admin\DashboardController@getDashboard')->name('admin.dashboard');
        Route::post('logout', 'Admin\AuthController@logout')->name('admin.logout');

        Route::get('merks', 'Admin\MerkController@index')->name('merk.index');
        Route::get('merksData', 'Admin\MerkController@indexData')->name('merk.indexData');
        Route::get('merk/{id?}', 'Admin\MerkController@detail')->name('merk.detail');
        Route::post('merk/{id?}', 'Admin\MerkController@save')->name('merk.save');
    });
});
