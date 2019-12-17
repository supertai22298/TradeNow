<?php
Route::delete('product_promotions/destroy', 'ProductPromotionController@massDestroy')->name('product_promotions.massDestroy');
Route::resource('product_promotions', 'ProductPromotionController');
