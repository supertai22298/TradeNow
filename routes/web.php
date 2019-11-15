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

use App\Jobs\SendMailTest;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('/', function () {
        return view('admins.layout.master');
    });
    
    Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');
    Route::resource('brands', 'BrandController');
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoryController');
    Route::resource('users', 'UserController');
    Route::delete('users/destroy', 'UserController@massDestroy')->name('users.massDestroy');

    Route::put('contacts/changeStar', 'ContactController@changeStar')->name('contacts.changeStar');
    Route::get('contacts/star', 'ContactController@star')->name('contacts.star');
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactController');
}); 
