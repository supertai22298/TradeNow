<?php

Route::group(['as' => 'cart.'], function () {

  Route::get('carts/view', 'CartController@view')->name('view');
  Route::get('carts/checkout', 'CartController@checkout')->name('checkout');
  Route::post('carts/checkout', 'CartController@handleCheckout')->name('handleCheckout');
});
