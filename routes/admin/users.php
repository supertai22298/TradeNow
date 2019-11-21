<?php
 Route::delete('users/destroy', 'UserController@massDestroy')->name('users.massDestroy');
 Route::resource('users', 'UserController');