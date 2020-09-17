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
Route::post('change-password', 'Web\AuthController@postChangePassword')->name('web.changePassword');

Route::post('login', 'Web\AuthController@postLogin')->name('web.login');
Route::get('logout', 'Web\AuthController@logout')->name('web.logout');

Route::get('product/category/{category?}', 'Web\ProductController@getCategoryList')->name('web.category.list');
Route::get('product/detail/{id?}', 'Web\ProductController@getProductDetail')->name('web.product.detail');

Route::get('cart/list', 'Web\CartController@getCartList')->name('web.cart.list');
Route::post('cart/add', 'Web\CartController@postAddCart')->name('web.cart.add');
Route::post('cart/update', 'Web\CartController@postUpdateCart')->name('web.cart.update');
Route::get('cart/remove/{id}', 'Web\CartController@removeCart')->name('web.cart.remove');
Route::get('cart/destroy', 'Web\CartController@destroyCart')->name('web.cart.destroy');

Route::get('provinces', 'Web\RajaOngkirController@getAllProvinces')->name('web.provinces');
Route::get('cities/{province_id?}', 'Web\RajaOngkirController@getCities')->name('web.cities');

Route::get('blog/list', 'Web\BlogController@getBlogList')->name('web.blog.list');
Route::get('blog/detail/{id}', 'Web\BlogController@getBlogDetail')->name('web.blog.detail');

Route::post('midtrans-notification/handling', 'Web\MidtransController@handlingCallback')->name('web.midtrans.handling');
Route::get('midtrans-notification/finish', 'Web\MidtransController@finish')->name('web.midtrans.finish');
Route::get('midtrans-notification/unfinish', 'Web\MidtransController@unfinish')->name('web.midtrans.unfinish');
Route::get('midtrans-notification/error', 'Web\MidtransController@error')->name('web.midtrans.error');

// API
Route::post('product/list', 'Web\ProductController@getProductList')->name('web.product.list');
Route::post('varian/detail', 'Web\ProductController@getVarianDetail')->name('web.varian.detail');

Route::middleware(['auth.customer'])->group(function() {
    Route::get('account/detail', 'Web\AccountController@getAccountDetail')->name('web.account.detail');
    Route::post('account/detail', 'Web\AccountController@postAccountDetail')->name('web.account.postDetail');

    Route::get('order/list', 'Web\AccountController@getListOrder')->name('web.account.getListOrder');
    Route::get('order/detail/{id}', 'Web\AccountController@getDetailOrder')->name('web.account.getDetailOrder');
    Route::post('order/confirmation', 'Web\AccountController@confirmationOrder')->name('web.account.confirmationOrder');

    Route::get('checkout', 'Web\TransactionController@checkout')->name('web.checkout');
    Route::post('payment', 'Web\TransactionController@payment')->name('web.payment');
});


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

        Route::get('customers', 'Admin\CustomerController@index')->name('customer.index');
        Route::get('customersData', 'Admin\CustomerController@indexData')->name('customer.indexData');
        Route::get('customer/{id?}', 'Admin\CustomerController@detail')->name('customer.detail');

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

        Route::get('invoices', 'Admin\InvoiceController@index')->name('invoice.index');
        Route::get('invoicesData', 'Admin\InvoiceController@indexData')->name('invoice.indexData');
        Route::get('invoice/{id?}', 'Admin\InvoiceController@detail')->name('invoice.detail');

        Route::get('orders', 'Admin\OrderController@index')->name('order.index');
        Route::get('ordersData', 'Admin\OrderController@indexData')->name('order.indexData');
        Route::get('order/{id?}', 'Admin\OrderController@detail')->name('order.detail');
        Route::post('order-change-status', 'Admin\OrderController@changeStatus')->name('order.changeStatus');

        Route::get('midtrans/status/{id?}', 'Admin\MidtransController@status')->name('midtrans.status');
        Route::get('midtrans/reject/{id?}', 'Admin\MidtransController@reject')->name('midtrans.reject');
        Route::get('midtrans/approve/{id?}', 'Admin\MidtransController@approve')->name('midtrans.approve');

        Route::get('variansData/{productId?}', 'Admin\VarianController@indexData')->name('varian.indexData');
        Route::get('varian/changeStatus/{id?}', 'Admin\VarianController@changeStatus')->name('varian.changeStatus');
        Route::get('varian/{id?}/{productId?}', 'Admin\VarianController@detail')->name('varian.detail');
        Route::post('varian/{id?}/{productId?}', 'Admin\VarianController@save')->name('varian.save');

        Route::get('blogs', 'Admin\BlogController@index')->name('blog.index');
        Route::get('blogsData', 'Admin\BlogController@indexData')->name('blog.indexData');
        Route::get('blog/changeStatus/{id?}', 'Admin\BlogController@changeStatus')->name('blog.changeStatus');
        Route::get('blog/{id?}', 'Admin\BlogController@detail')->name('blog.detail');
        Route::post('blog/{id?}', 'Admin\BlogController@save')->name('blog.save');

        Route::get('reports', 'Admin\ReportController@index')->name('report.index');
    });
});
