<?php
 Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
 Route::resource('categories', 'CategoryController');