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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {

  //This group contains the functions that the administrator can handle
  Route::group(['middleware' => 'admin'], function () {
    include_once 'admin/censorships.php';
    include_once 'admin/brands.php';
    include_once 'admin/contacts.php';
    include_once 'admin/users.php';
    include_once 'admin/categories.php';
    include_once 'admin/promotions.php';

  });
  Route::get('/', 'DashboardController@index');
  include_once 'admin/dashboard.php';
  include_once 'admin/products.php';
  include_once 'admin/orders.php';
});



Auth::routes();

Route::group(['prefix' => '/', 'as' => 'client.', 'namespace' => 'Client'], function () {
  Route::get('/', 'HomePageController@index')->name('index');

  include_once 'client/user.php';
  include_once 'client/categories.php';
  include_once 'client/products.php';
  include_once 'client/carts.php';
});

// Route::get('/home', 'HomeController@index')->name('home')
