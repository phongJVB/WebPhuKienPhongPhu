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
    return view('welcome');
});
//Tạo Router theo Group của từng phần trong Admin
Route::prefix('admin')->group(function(){
	//Tạo Router cho product trong Admin
	Route::name('product.')->prefix('product')->group(function() {
		Route::get('/', 'Admin\ProductController@index')->name('index');
		Route::get('/show/{id}', 'Admin\ProductController@show')->name('show');
		Route::get('/create', 'Admin\ProductController@create')->name('create');
		Route::post('/store', 'Admin\ProductController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\ProductController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\ProductController@destroy')->name('destroy');
	});

});



// Router gọi đến trang chủ của website
Route::get('/home','pageController@getHome')->name('home');

// Router gọi đến ProductType của website
Route::get('/product_type','pageController@getProductType')->name('productType');

// Router gọi đến xem chi tiết Product của website
Route::get('/product','pageController@getProduct')->name('product');

// Router gọi đến xem page giới thiệu của website
Route::get('/about','pageController@getAbout')->name('about');

// Router gọi đến xem page liên hệ của website
Route::get('/contact','pageController@getContact')->name('contact');