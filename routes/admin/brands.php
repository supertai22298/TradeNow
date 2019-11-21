<?php
 Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');
 Route::resource('brands', 'BrandController');