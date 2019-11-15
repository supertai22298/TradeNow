<?php
 Route::resource('users', 'UserController');
 Route::delete('users/destroy', 'UserController@massDestroy')->name('users.massDestroy');