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
    return redirect()->route('web.homePage');
});

Route::get('home', 'Web\HomeController@getHomePage')->name('web.homePage');

Route::get('register', 'Web\AuthController@getRegisterPage')->name('web.registerPage');
Route::post('register', 'Web\AuthController@postRegister')->name('web.register');

Route::post('login', 'Web\AuthController@postLogin')->name('web.login');
Route::get('logout', 'Web\AuthController@logout')->name('web.logout');

Route::get('product/category/{category?}', 'Web\ProductController@getCategoryList')->name('web.category.list');
Route::get('product/detail/{id?}', 'Web\ProductController@getProductDetail')->name('web.product.detail');

Route::get('blog/list', 'Web\blogController@getBlogList')->name('web.blog.list');

// API
Route::post('product/list', 'Web\ProductController@getProductList')->name('web.product.list');
Route::post('varian/detail', 'Web\ProductController@getVarianDetail')->name('web.varian.detail');


Route::prefix('admin')->group(function() {
    Route::get('/', function () {
        return redirect()->route('admin.getLogin');
    });

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
        Route::get('merkFind', 'Admin\MerkController@find')->name('merk.find');

        Route::get('colors', 'Admin\ColorController@index')->name('color.index');
        Route::get('colorsData', 'Admin\ColorController@indexData')->name('color.indexData');
        Route::get('color/{id?}', 'Admin\ColorController@detail')->name('color.detail');
        Route::post('color/{id?}', 'Admin\ColorController@save')->name('color.save');
        Route::get('colorFind', 'Admin\ColorController@find')->name('color.find');

        Route::get('products', 'Admin\ProductController@index')->name('product.index');
        Route::get('productsData', 'Admin\ProductController@indexData')->name('product.indexData');
        Route::get('product/changeStatus/{id?}', 'Admin\ProductController@changeStatus')->name('product.changeStatus');
        Route::get('product/{id?}', 'Admin\ProductController@detail')->name('product.detail');
        Route::post('product/{id?}', 'Admin\ProductController@save')->name('product.save');

        Route::get('variansData/{productId?}', 'Admin\VarianController@indexData')->name('varian.indexData');
        Route::get('varian/changeStatus/{id?}', 'Admin\VarianController@changeStatus')->name('varian.changeStatus');
        Route::get('varian/{id?}/{productId?}', 'Admin\VarianController@detail')->name('varian.detail');
        Route::post('varian/{id?}/{productId?}', 'Admin\VarianController@save')->name('varian.save');

        Route::get('blogs', 'Admin\BlogController@index')->name('blog.index');
        Route::get('blogsData', 'Admin\BlogController@indexData')->name('blog.indexData');
        Route::get('blog/changeStatus/{id?}', 'Admin\BlogController@changeStatus')->name('blog.changeStatus');
        Route::get('blog/{id?}', 'Admin\BlogController@detail')->name('blog.detail');
        Route::post('blog/{id?}', 'Admin\BlogController@save')->name('blog.save');
    });
});
