<?php
Route::delete('product_promotions/massDestroy', 'ProductPromotionController@massDestroy')->name('product_promotions.massDestroy');
Route::delete('product_promotions/destroy/{product_id}/{promotion_id}', 'ProductPromotionController@destroy')->name('product_promotions.destroy');
Route::resource('product_promotions', 'ProductPromotionController')->except([
  'destroy'
]);
