<?php
Route::resource('promotions', 'PromotionController');
Route::post('promotions/destroy', 'PromotionController@massDestroy')->name('promotion.massDestroy');
