<?php
 Route::delete('products/destroy', 'CategoryController@massDestroy')->name('products.massDestroy');

Route::resource('products', 'ProductController');