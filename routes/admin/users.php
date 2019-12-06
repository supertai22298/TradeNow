<?php
 Route::delete('users/destroy', 'UserController@massDestroy')->name('users.massDestroy');
 Route::get('profile', 'UserController@profile')->name('users.profile');
 Route::resource('users', 'UserController');