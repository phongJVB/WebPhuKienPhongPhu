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

Route::get('/admin', 'Admin\ProductsController@index')->name('admin');
//Tạo Router theo Group của từng phần trong Admin
Route::name('admin.')->prefix('admin')->group(function(){

	//Tạo Router cho product trong Admin
	Route::name('product.')->prefix('product')->group(function() {
		Route::get('/', 'Admin\ProductsController@index')->name('index');
		Route::get('/show/{id}', 'Admin\ProductsController@show')->name('show');
		Route::get('/create', 'Admin\ProductsController@create')->name('create');
		Route::post('/store', 'Admin\ProductsController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\ProductsController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\ProductsController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\ProductsController@destroy')->name('destroy');
	});

	//Tạo Router cho categories trong Admin
	Route::name('category.')->prefix('category')->group(function() {
		Route::get('/', 'Admin\CategoriesController@index')->name('index');
		Route::get('/show/{id}', 'Admin\CategoriesController@show')->name('show');
		Route::get('/create', 'Admin\CategoriesController@create')->name('create');
		Route::post('/store', 'Admin\CategoriesController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\CategoriesController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\CategoriesController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\CategoriesController@destroy')->name('destroy');
	});

	//Tạo Router cho users trong Admin
	Route::name('user.')->prefix('user')->group(function() {
		Route::get('/', 'Admin\UsersController@index')->name('index');
		Route::get('/show/{id}', 'Admin\UsersController@show')->name('show');
		Route::get('/create', 'Admin\UsersController@create')->name('create');
		Route::post('/store', 'Admin\UsersController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\UsersController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\UsersController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\UsersController@destroy')->name('destroy');
	});

	//Tạo Router cho orders trong Admin
	Route::name('order.')->prefix('order')->group(function() {
		Route::get('/', 'Admin\OrdersController@index')->name('index');
		Route::get('/show/{id}', 'Admin\OrdersController@show')->name('show');
		Route::get('/create', 'Admin\OrdersController@create')->name('create');
		Route::post('/store', 'Admin\OrdersController@store')->name('store');
		Route::get('/edit/{id}', 'Admin\OrdersController@edit')->name('edit');
		Route::post('/update/{id}', 'Admin\OrdersController@update')->name('update');
		Route::get('/destroy/{id}', 'Admin\OrdersController@destroy')->name('destroy');
	});
});


Route::name('home.')->prefix('home')->group(function(){
		// Router gọi đến trang chủ của website
		Route::get('/','PageController@getHome')->name('index');

		// Router gọi đến ProductType của website
		Route::get('/product_type','PageController@getProductType')->name('productType');

		// Router gọi đến xem chi tiết Product của website
		Route::get('/productDetail','PageController@getProduct')->name('productDetail');

		// Router gọi đến xem page giới thiệu của website
		Route::get('/about','PageController@getAbout')->name('about');

		// Router gọi đến xem page liên hệ của website
		Route::get('/contact','PageController@getContact')->name('contact');

		//Route xử lý giỏ hàng
		Route::get('/showShoppingCart','CartController@showCart')->name('showShoppingCart');
		Route::post('/shoppingCart','CartController@addToCart')->name('shoppingCart');
		Route::post('/updateCart','CartController@updateCart')->name('updateCart');
		Route::get('/removeCart/{rowId}','CartController@removeCart')->name('removeCart');

		// Router gọi đến xử lý trang đặt hàng của website
		Route::get('/checkout','PageController@getCheckout')->name('checkout');
		Route::post('/checkout','PageController@postCheckout')->name('checkout');

		// Router gọi đến trang login của website
		Route::get('/login','PageController@getLogin')->name('login');
		Route::post('/login','PageController@postLogin')->name('login');

		// Router gọi đến trang đăng ký của website
		Route::get('/register','PageController@getRegister')->name('register');
		Route::post('/register','PageController@postRegister')->name('register');

		// Router gọi đến đăng xuất của website
		Route::get('/logout','PageController@getLogout')->name('logout');

});
