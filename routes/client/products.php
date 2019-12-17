<?php

Route::get('products/{product}', 'ProductController@show')->name('products.show');
Route::post('products/addReview', 'ProductController@addReview')->name('products.addReview');
