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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
  Route::get('/', 'DashboardController@index');
  include_once 'admin/dashboard.php';
  include_once 'admin/contacts.php';
  include_once 'admin/users.php';
  include_once 'admin/brands.php';
  include_once 'admin/categories.php';
  include_once 'admin/censorships.php';
  include_once 'admin/products.php';
  Route::resource('promotions','PromotionController');
  Route::post('promotions/destroy', 'PromotionController@massDestroy')->name('promotion.massDestroy');
   
});


