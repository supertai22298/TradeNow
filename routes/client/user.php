<?php
  Route::get('user/', 'UserController@profile')->name('users.profile');
  Route::post('user/', 'UserController@update')->name('users.update');
  Route::post('user/changPassword', 'UserController@changePassword')->name('users.changePassword');
  Route::get('user/order', 'UserController@order')->name('users.order');
