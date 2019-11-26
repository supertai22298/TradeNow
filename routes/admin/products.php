<?php
 Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');

Route::resource('products', 'ProductController');