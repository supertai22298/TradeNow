<?php
Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
Route::put('orders/{order}/changeStatus', 'OrderController@changeStatus')->name('orders.changeStatus');
Route::resource('orders', 'OrderController');